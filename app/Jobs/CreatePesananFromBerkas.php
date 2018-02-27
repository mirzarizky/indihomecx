<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Excel;
use App\Jobs\StorePesanan;
use App\Berkas;
use Illuminate\Support\Facades\Log;

class CreatePesananFromBerkas implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $idBerkas;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($idBerkas)
    {
        $this->idBerkas = $idBerkas;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Create Pesanan dari berkas ".$this->idBerkas." dimulai");
        $berkas = Berkas::findOrFail($this->idBerkas);
        $path = 'storage/app/public/'.$berkas->path;

        $excel = Excel::selectSheetsByIndex(0)->load($path, function($reader)
        {
            $reader
                ->select(array('order_id', 'order_date', 'customer_name', 'no_hp', 'email', 'sto', 'log_status' ))
                ->get();
        });
        $data = $excel->get();
        $totalRows = $data->count();
        Log::info("Total baris pada berkas ".$this->idBerkas." : ".$totalRows);
        for ($i=0; $i < $totalRows; $i+=500) {
            if ($i > $totalRows) {
                break;
            }
            StorePesanan::dispatch($berkas->id, $i);
        }
    }
}
