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
                    return view('notify')->with(['title'=>'Oops!','message'=>'Maaf, anda sudah mengisi survei ini.']);
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
            'feedback' => 'max:450',
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
            return view('notify')->with(['title'=>'Terimakasih', 'message'=>'Respon anda telah kami terima.']);
        }
    }

}
