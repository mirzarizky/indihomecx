<?php

namespace App\Jobs;

use App\Berkas;
use App\Cabang;
use App\Pesanan;
use App\Status;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Excel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class StorePesanan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $idBerkas;
    protected $skipRows;

    public function __construct($idBerkas, $skipRows)
    {
        $this->idBerkas = $idBerkas;
        $this->skipRows = $skipRows;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Berkas $berkas)
    {
        Log::info("Menambahkan Order dari berkas ".$this->idBerkas.". Dari kolom ".$this->skipRows." Sampai ".($t = $this->skipRows + 500));
        $file = $berkas->findOrFail($this->idBerkas);
        $path = 'storage/app/public/'.$file->path;
        $skip = $this->skipRows;

        $excel = Excel::selectSheetsByIndex(0)->load($path, function($reader) use($skip)
        {
            $reader
                ->skipRows($skip)->takeRows(500)
                ->select(array('order_id', 'order_date', 'customer_name', 'no_hp', 'email', 'sto', 'log_status' ))
                ->get();
        });
        $data = $excel->get();
        $allSTO = Cabang::all();
        $allStatus = Status::all();

        if (!empty($data) && $data->count()) {
            foreach($data as $row => $value) {
                foreach ($allSTO as $key => $sto) {
                    if (($value->sto == $sto->kode) || ($value->sto == Str::upper($sto->kode))) {
                        foreach ($allStatus as $keys => $status) {
                            $hasStatus = strpos($value->log_status, $status->kode);
                            if ($hasStatus !== false) {
                                Pesanan::firstOrCreate ([
                                    'id' => $value->order_id,
                                    'namaPelanggan' => $value->customer_name,
                                    'noHpPelanggan' => $value->no_hp,
                                    'tanggal' => date('Y-m-d H:i:s', strtotime($value->order_date)),
                                    'emailPelanggan' => $value->email,
                                    'status_kode' => $status->kode,
                                    'cabang_kode' => $sto->kode,
                                    'berkas_id' => $this->idBerkas,
                                ]);
                                if(!empty($value->no_hp)) {
                                    $file->totalNoHp += 1;
                                }
                                if (!empty($value->email)) {
                                    $file->totalEmail += 1;
                                }
                                $file->totalPesanan += 1;
                                $file->save();
                                break;
                            }
                            unset($status);
                        }
                        break;
                    }
                    unset($sto);
                }
                unset($value);
            }
        }
        Log::info("################ SELESAI ################");
    }
}
