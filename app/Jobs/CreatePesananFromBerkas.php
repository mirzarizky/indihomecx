<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Berkas;
use Illuminate\Support\Facades\Log;
use Excel;

class CreatePesananFromBerkas implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $idBerkas;
    protected $sendNow;

    public function __construct($idBerkas, $send)
    {
        $this->idBerkas = $idBerkas;
        $this->sendNow = $send;
    }

    public function handle()
    {
        Log::info("Create Pesanan dari berkas ".$this->idBerkas." dimulai");
        $berkas = Berkas::findOrFail($this->idBerkas);
        if (!empty($berkas)) {

            $path = 'storage/app/public/'.$berkas->path;

            $excel = Excel::selectSheetsByIndex(0)->load($path, function($reader)
            {
                $reader
                    ->select(array('order_id', 'order_date', 'customer_name', 'no_hp', 'email', 'sto', 'log_status'))
                    ->get();
            });

            if($excel) {
                $berkas->berkasStatus = 1;
                $berkas->save();
                $data = $excel->get();

                $totalRows = $data->count();
                Log::info("Total baris pada berkas ".$this->idBerkas." : ".$totalRows);
                Log::info("Kirim Sekarang? ".$this->sendNow);

                for ($i=0; $i < $totalRows; $i+=500) {
                    StorePesanan::dispatch($this->idBerkas, $i);
                    if ($i > $totalRows - 500) {
                        BerkasStatus::dispatch($this->idBerkas, 2);
                        if($this->sendNow) {
                            CreateSendingMailSMS::dispatch($this->idBerkas);
                        }
                        break;
                    }
                }
            }
        }
    }
}
