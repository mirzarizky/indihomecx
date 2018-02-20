<?php

namespace App\Http\Controllers;

use App\Berkas;
use App\Cabang;
use App\Jobs\StorePesanan;
use App\Jobs\CreatePesananFromBerkas;
use App\Status;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Pesanan;
use Excel;
use Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $rolename = Auth::user()->role->name;
            return view('home', compact('rolename'));
    }

    public function excel()
    {
        CreatePesananFromBerkas::dispatch(1);
//        $file = Berkas::findOrFail(1);
//        $path = 'storage/app/'.$file->path;
//        $skip = 0;
//        $excel = Excel::selectSheetsByIndex(0)->load($path, function($reader) use($skip)
//        {
//            $reader
//                ->skipRows($skip)->takeRows(500)
//                ->select(array('order_id', 'order_date', 'customer_name', 'no_hp', 'email', 'sto', 'log_status' ))
//                ->get();
//        });
//        $data = $excel->get();
//        $allSTO = Cabang::all();
//        $allStatus = Status::all();
//
//        if (!empty($data) && $data->count()) {
//            foreach($data as $row => $value) {
//                foreach ($allSTO as $key => $sto) {
//                    if (($value->sto == $sto->kode) || ($value->sto == Str::upper($sto->kode))) {
//                        foreach ($allStatus as $keys => $status) {
//                            $hasStatus = strpos($value->log_status, $status->kode);
//                            if ($hasStatus !== false) {
//                                Pesanan::firstOrNew([
//                                    'id' => $value->order_id,
//                                    'namaPelanggan' => $value->customer_name,
//                                    'noHpPelanggan' => $value->no_hp,
//                                    'tanggal' => date('Y-m-d H:i:s', strtotime($value->order_date)),
//                                    'emailPelanggan' => $value->email,
//                                    'status_kode' => $status->kode,
//                                    'cabang_kode' => $value->sto,
//                                    'berkas_id' => 1,
//                                ]);
//                                break;
//                            }
//                            unset($status);
//                        }
//                        break;
//                    }
//                    unset($sto);
//                }
//                unset($value);
//            }
//        }

        return redirect()->route('admin.model.index', ['model'=>'berkas'])->with(['status'=>'Berkas sedang diproses']);
    }
}
