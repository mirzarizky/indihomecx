<?php

namespace App\Jobs;

use App\Pesanan;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class SendMailAndSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $idOrder;

    public function __construct($id)
    {
        $this->idOrder = $id;
    }

    public function handle()
    {
        $order = Pesanan::findOrFail($this->idOrder);
        Log::info('Sending email & berkas ke order : '.$this->idOrder.'. Email : '.$order->emailPelanggan.'; Hp :'.$order->noHpPelanggan);
    }
}
