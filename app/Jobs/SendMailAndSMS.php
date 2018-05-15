<?php

namespace App\Jobs;

use App\Mail\SurveyLinkMail;
use App\Pesanan;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Shortener\Facades\Shortener;
use Illuminate\Support\Facades\Mail;

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
        $encryptedId = Crypt::encryptString($order->id);
        $data = array(
            'subject' => 'Survey untuk : '.$order->namaPelanggan,
            'nama' => $order->namaPelanggan,
            'email' => $order->emailPelanggan,
            'encryptedId' => $encryptedId
        );
        Mail::to($order->emailPelanggan)->send(new SurveyLinkMail($data));
        $shortedURL = Shortener::short(config('app.url').'/s/'.$encryptedId);
        $nohttpURL = substr($shortedURL, 8);
        Log::info('Sending email & berkas ke order : '.$this->idOrder.'. Email : '.$order->emailPelanggan.'; Hp :'.$order->noHpPelanggan.'Link : '.$nohttpURL);
//        TODO : fungsi kirim sms (later)
    }
}
