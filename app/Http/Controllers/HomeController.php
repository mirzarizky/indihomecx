<?php

namespace App\Http\Controllers;

use App\Berkas;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use Excel;
use Auth;



class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $rolename = Auth::user()->role->name;
        return view('home', compact('rolename'));
    }

    public function download($id)
    {
        $file = Berkas::findOrFail($id);
        return Storage::download($file->path);
    }

    public function survei($id) {
        if (!empty($id)) {
            return redirect()->route('survei')->with(['id' => $id]);
        } else {
            return abort(404);
        }
    }

    public function indexSurvei() {
        if(session('id')==200){
            return view('welcome')->with('id', session('id'));
        } else {
            return redirect()->away('https://google.com');
//            return abort(404);
        }
    }

    public function sendmailsms($id) {
//        SendMailAndSMS::dispatch($id);
//        $encrypted = Crypt::encryptString($id);
        try {
            $encrypted = Crypt::decryptString($id);
            return $encrypted;
        } catch (DecryptException $e) {
            return redirect()->route('welcome');
        }
    }

    public function testDecrypt($id) {
        $encrypted = Crypt::encryptString($id);
        return $encrypted;
    }
}
