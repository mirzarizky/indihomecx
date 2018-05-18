<?php

namespace App\Http\Controllers;

use App\DetailKriteria;
use App\Kriteria;
use App\Pesanan;
use App\Survei;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SpvController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isSupervisor');
        $this->middleware('isDefaultPassword');
    }

    public function indexSpv()
    {
        $factors = Kriteria::all();
        $totalDetailFactor = DetailKriteria::count();
        $totalOrderThisWeek = Pesanan::whereBetween('tanggal', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->count();
        $totalSurvey = Survei::count();
        $ratings = Survei::orderBy('nilai', 'asc')->get()->groupBy('nilai');
        $total = array(
            'order' => $totalOrderThisWeek,
            'survey' => $totalSurvey,
            'detailFactor' => $totalDetailFactor
        );
        $allSurvey = Survei::paginate(1000);

        return view('spv.index', compact('total', 'allSurvey', 'factors', 'ratings'));
    }
}
