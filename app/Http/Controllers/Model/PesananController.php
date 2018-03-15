<?php

namespace App\Http\Controllers\Model;

use App\Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PesananController extends Controller
{
    public function index() {
        $orders = Pesanan::paginate(100);
        return view('admin.pesanan.index', compact('orders'));
    }
}
