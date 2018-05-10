<?php

namespace App\Jobs;

use App\Berkas;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class BerkasStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $idBerkas;
    protected $status;

    public function __construct($id, $status)
    {
        $this->idBerkas = $id;
        $this->status = $status;

    }

    public function handle()
    {
        Berkas::where('id', $this->idBerkas)
            ->update(['berkasStatus' => $this->status]);
    }
}
