<?php

namespace App\Http\Controllers\Model;

use App\Avatar;
use App\Http\Controllers\Controller;
use App\Mail\NewUserMail;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $adminRole = Role::where('name', 'admin')->first();
        $spvRole = Role::where('name', 'supervisor')->first();
        $users = User::whereIn('role_id', [$adminRole->id, $spvRole->id])->get();
        return view('admin.user.index', compact('users'));
    }

    public function indexMe() {
        $user = User::FindOrFail(Auth::user()->id);
        return view('profile.index', compact('user'));
    }

    public function indexEdit() {
        $user = User::FindOrFail(Auth::user()->id);
        return view('profile.update', compact('user'));
    }

    public function indexUpdatePassword() {
        return view('profile.password');
    }

    public function updateProfilePassword(Request $request) {
        $request->validate([
            'oldPassword' => 'required|string|min:6'
        ]);
        $user = User::FindOrFail(Auth::user()->id);
        if (Hash::check($request->oldPassword, $user->password))
        {
            return $this->updatePassword($request);
        } else {
            return redirect()->back()->withErrors(['oldPassword'=> 'Hahaha Salah nih!']);
        }
    }

    public function indexForm() {
        $roles = Role::all();
        return view('admin.user.form', compact('roles'));
    }

    public function updateMe(Request $request) {
        $request->validate([
            'photo' => 'file|nullable|mimes:jpeg,jpg,png|max:2048',
            'nama' => 'required|string|max:255',
            'noHp' => 'string|nullable',
            'email' => 'required|string|email|max:255|'
        ]);
        $user = User::FindOrFail(Auth::user()->id);
        if(!empty($request->photo)) {
            if (!empty($user->avatar_id)){
                $avatar = Avatar::findOrFail($user->avatar_id);
                Storage::disk('public')->delete($user->avatar->path);
                $path = $request->file('photo')->store('avatars', 'public');
                $extension = pathinfo($path);

                Avatar::where('id', $avatar->id)
                    ->update([
                        'name' => date('Ymd-His').'_'.$user->id.'.'.$extension['extension'],
                        'path' => $path
                    ]);
                User::where('id', $user->id)
                    ->update([
                        'name' => $request->nama,
                        'noHp' => $request->noHp,
                        'email' => $request->email,
                        'avatar_id' => $avatar->id
                    ]);
            } elseif(empty($user->avatar_id)){
                $path = $request->file('photo')->store('avatars', 'public');
                $extension = pathinfo($path);
                $newAvatar = Avatar::create([
                    'name' => date('Ymd-His').'_'.$user->id.'.'.$extension['extension'],
                    'path' => $path,
                ]);
                User::where('id', $user->id)
                    ->update([
                       'name' => $request->nama,
                       'noHp' => $request->noHp,
                       'email' => $request->email,
                       'avatar_id' => $newAvatar->id
                    ]);
            }
        } elseif (($user->name == $request->nama) && ($user->email == $request->email) && ($user->noHp == $request->noHp)) {
            return redirect()->back()->with(['status' => 'Anda tidak mengubah apapun']);
        } else {
            User::where('id', $user->id)
                ->update([
                    'name' => $request->nama,
                    'noHp' => $request->noHp,
                    'email' => $request->email
                ]);
        }

        return redirect()->route('profile.index')->with(['status' => 'Profil berhasil diperbaharui.']);
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
        $user = User::where('id',$id)->first();
        Storage::delete($user->avatar->path);
        Avatar::destroy($user->avatar_id);

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

        $currentUser = Auth::user();

        User::where('id', $currentUser->id)
            ->update([
                'password' => bcrypt($request->password),
                'defaultPassword' => false
            ]);

        return redirect()->route('profile.index');
    }
}
