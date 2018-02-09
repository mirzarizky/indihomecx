<?php

namespace App\Http\Controllers\Model;

use App\Berkas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BerkasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $allBerkas = Berkas::all();

        return view('admin.berkas.index', compact('allBerkas'));
    }

    public function indexForm() {

        return view('admin.berkas.form');
    }

    public function create(Request $request) {

        $request->validate([
            'daterange' => 'required',
            'berkas' => 'required|file'
        ]);

        $file = $request->file('berkas');
        $fileName = $file->getClientOriginalName();
        $path = $file->storeAs('public/berkas', $fileName);

        list ($start, $end) = explode('-', $request->daterange);
        $startDate = str_replace("/","-",$start);
        $endDate = str_replace("/","-", $end);

        Berkas::create([
            'nama' => $fileName,
            'path' => $path,
            'tanggalMulaiPesanan' => $startDate,
            'tanggalAkhirPesanan' => $endDate
        ]);
        return redirect()
            ->route('admin.model.index', ['model' => 'berkas'])
            ->with(['status' => 'Berkas berhasil ditambahkan!']);
    }

    public function updateForm($id) {
        $berkas = Berkas::FindOrFail($id);

        return view('admin.berkas.updateform', compact('berkas'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'daterange' => 'required',
            'nama' => 'required|string|max:255'
        ]);

        list ($start, $end) = explode('-', $request->daterange);
        $startDate = str_replace("/","-",$start);
        $endDate = str_replace("/","-", $end);

        Berkas::where('id', $id)
            ->update([
                'nama' => $request->nama,
                'tanggalMulaiPesanan' => $startDate,
                'tanggalAkhirPesanan' => $endDate
            ]);

        return redirect()
            ->route('admin.model.index', ['model' => 'berkas'])
            ->with(['status' => 'Berkas berhasil diperbaharui!']);
    }

    public function delete($id)
    {
        $berkas = Berkas::findOrFail($id);
        Storage::delete($berkas->path);
//        $berkas->delete();

        return redirect()
            ->route('admin.model.index', ['model' => 'berkas'])
            ->with(['status' => 'Berkas berhasil dihapus!']);
    }

    public function download($id)
    {
        $berkas = Berkas::findOrFail($id);
        return Storage::download($berkas->path, $berkas->nama);
    }
}
