<?php

namespace App\Http\Controllers\Model;

use App\Http\Controllers\Controller;
use App\Mail\NewUserMail;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function indexForm() {
        $roles = Role::all();
        return view('admin.user.form', compact('roles'));
    }

    public function create(Request $request) {

        $request->validate([
            'role' => 'required|numeric',
            'nama' => 'required|string|max:255',
            'nik' => 'required|numeric|unique:users',
            'email' => 'required|string|email|max:255|unique:users'
        ]);

        $defaultPassword = Str::random(12);

        $data = array(
            'subject' => 'Selamat Datang '.$request->nama,
            'nama' => $request->nama,
            'email' => $request->email,
            'nik' => $request->nik,
            'password' => $defaultPassword
        );

        Mail::to($request->email)->send(new NewUserMail($data));

        $newUser = User::create([
            'nik' => $request->nik,
            'name' => $request->nama,
            'email' => $request->email,
            'role_id' => $request->role,
            'password' => bcrypt('password')
        ]);
        return redirect()->route('admin.model.index', ['model' => 'user'])->with(['status' => 'User berhasil ditambahkan! Silahkan cek email untuk keterangan lebih lanjut.']);
    }

    public function updateForm($id) {
        $user = User::FindOrFail($id);
        $roles = Role::whereNotIn('name',[$user->role->name])->get();

        return view('admin.user.updateform', compact('user', 'roles'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'role' => 'required|numeric',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|'
        ]);

        User::where('id', $id)
            ->update([
                'role_id' => $request->role,
                'name' => $request->nama,
                'email' => $request->email
            ]);

        return redirect()->route('admin.model.index', ['model' => 'user'])->with(['status' => 'User berhasil diperbaharui!']);
    }

    public function delete($id)
    {
        User::destroy($id);

        return redirect()->route('admin.model.index', ['model' => 'user'])->with(['status' => 'User berhasil dihapus!']);
    }

    public function firstLogin()
    {
        if ((Auth::user()->defaultPassword == 0) && (Auth::user()->role->name == 'admin')) {
            return redirect()->route('admin.index');
        } elseif ((Auth::user()->defaultPassword == 0) && (Auth::user()->role->name == 'supervisor')) {
            return redirect('/spv');
        }
        return view('first');

    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed'
        ]);

        $currentUser = (Auth::user());

        User::where('id', $currentUser->id)
            ->update([
                'password' => bcrypt($request->password),
                'defaultPassword' => false
            ]);

        return redirect()->route('admin.index');
    }
}
