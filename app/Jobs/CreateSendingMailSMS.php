<?php

namespace App\Jobs;

use App\Berkas;
use App\Pesanan;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class CreateSendingMailSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $idBerkas;

    public function __construct($id)
    {
        $this->idBerkas = $id;
    }

    public function handle()
    {
        Log::info('Creating Sending Email & SMS from berkas : '.$this->idBerkas);
        $currentBerkas = Berkas::find($this->idBerkas);
        $currentBerkas->berkasStatus = 3;
        $currentBerkas->save();
        $allOrders = Pesanan::where('berkas_id', $this->idBerkas)
            ->where([
                ['emailPelanggan', '<>', null],
                ['noHpPelanggan', '<>', null]
            ])
            ->get();

        $totalOrders = count($allOrders);
        $i = 0;
        foreach ($allOrders as $key => $order) {
            SendMailAndSMS::dispatch($order->id);
            if(++$i === $totalOrders) {
                BerkasStatus::dispatch($this->idBerkas, 4);
            }
        }

    }
}
