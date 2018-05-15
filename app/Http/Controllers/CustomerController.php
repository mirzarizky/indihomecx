<?php

namespace App\Http\Controllers;

use App\DetailKriteria;
use App\Kriteria;
use App\Pesanan;
use App\Survei;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Validator;

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
            $allFactor = Kriteria::all();
            $order_id = session('id');
            return view('survey', compact('allFactor', 'order_id'));
        } else {
//            TODO : redirect ke 404 atau kemana ya?
            return abort(404);
        }
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|min:1|max:5',
            'factors' => 'required|array',
            'feedback' => 'required|min:10',
        ]);
        if ($validator->fails()) {
            return redirect()->route('survei')->with(['id' => $request->order_id])
                ->withErrors($validator)
                ->withInput();
        } else {
            $survey = Survei::create([
                'nilai' => $request->rating,
                'komentar' => $request->feedback,
                'pesanan_id' => $request->order_id
            ]);
            if ($survey) {
                foreach($request->factors as $factor) {
                    DetailKriteria::create([
                        'kriteria_id' => $factor,
                        'survei_id' => $survey->id
                    ]);
                }
                $order = Pesanan::findOrFail($request->order_id);
                $order->isSurvei = true;
                $order->save();
            }
            return view('succeed');
        }
    }

}
