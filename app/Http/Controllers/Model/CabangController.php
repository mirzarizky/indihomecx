<?php

namespace App\Http\Controllers\Model;

use App\Cabang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CabangController extends Controller
{
    public function index() {
        $allCabang = Cabang::all();
        return view('admin.cabang.index', compact('allCabang'));
    }

    public function indexForm() {

        return view('admin.cabang.form');
    }

    public function create(Request $request) {

        $request->validate([
            'kode' => 'required|unique:cabang|alpha|max:5',
            'nama' => 'required',
        ]);

        Cabang::create([
            'kode' => Str::upper($request->kode),
            'nama' => $request->nama
        ]);

        return redirect()->route('admin.model.index', ['model' => 'sto'])->with(['status' => 'STO berhasil ditambahkan!']);
    }

    public function updateForm($id) {
        $cabang = Cabang::FindOrFail($id);

        return view('admin.cabang.updateform', compact('cabang'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'kode' => 'required|unique:cabang|alpha|max:5',
            'nama' => 'required',
        ]);

       Cabang::where('id', $id)
           ->update([
               'kode' => Str::upper($request->kode),
               'nama' => $request->nama
           ]);

        return redirect()->route('admin.model.index', ['model' => 'sto'])->with(['status' => 'STO berhasil diperbaharui!']);
    }

    public function delete($id) {
        Cabang::destroy($id);

        return redirect()->route('admin.model.index', ['model' => 'sto'])->with(['status' => 'STO berhasil dihapus!']);
    }
}
