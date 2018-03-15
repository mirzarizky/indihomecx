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
            'berkas' => 'required|file|mimes:xlsx'
        ]);

        $file = $request->file('berkas');

        list ($start, $end) = explode('-', $request->daterange);
        $startDate = str_replace("/","-",$start);
        $endDate = str_replace("/","-", $end);

        $fileName = date('Ymd-His')."_DATA_".date('jM', strtotime($startDate))."-".date('jM', strtotime($endDate)).".xlsx";
        //$path = $file->storeAs('public/berkas', $fileName);
        $path = Storage::disk('public')->putFileAs('berkas', $file, $fileName);
        if (!empty(env('DROPBOX_TOKEN'))){
            Storage::disk('dropbox')->putFileAs('berkas', $file, $fileName);
        }

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
        $berkas = Berkas::findOrFail($id);

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
        Storage::disk('public')->delete($berkas->path);
//        $berkas->delete();

        return redirect()
            ->route('admin.model.index', ['model' => 'berkas'])
            ->with(['status' => 'Berkas berhasil dihapus!']);
    }

    public function download($id)
    {
        $berkas = Berkas::findOrFail($id);
        $url=Storage::disk('public')->temporaryUrl($berkas->path, now()->addMinutes(1));
        return dd($url);
    }
}
