<?php

namespace App\Http\Controllers;

use App\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Mbarwick83\Shorty\Facades\Shorty;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function survei($encryptedId) {
        if (!empty($encryptedId)) {
            try {
                $decrypted = Crypt::decryptString($encryptedId);
                $order = Pesanan::findOrFail($decrypted);
                if(!$order->isSurvei) {
//                    return 'kamu isi ini ya..';
                    return redirect()->route('survei')->with(['id' => $order->id]);
                } elseif ($order->isSurvei) {
//                    TODO : redirect ke page yang isinya notif ke user sudah tersurvey
                    return 'udah diisi shay. gaboleh isi lagi dong';
                } else {
                    return abort(404);
                }
            } catch (DecryptException $e) {
                return abort(404);
            }

        } else {
            return abort(404);
        }
    }

    public function indexSurvei() {
        if(session('id')){
//             TODO : redirect ke halaman survey & tambah field untuk id order (hidden)
//            return view('welcome')->with('id', session('id'));
            return session('id');
        } else {
            return redirect()->away('https://google.com');
//            return abort(404);
        }
    }

    public function shortme () {
        $shorted = Shorty::shorten('https://bit.ly/printmeup');
        return $shorted;
    }

}
