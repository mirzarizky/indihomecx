<?php

namespace App\Http\Controllers\Model;

use App\Berkas;
use App\Jobs\CreatePesananFromBerkas;
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
            'berkas' => 'required|file|mimes:xlsx',
            'send' => 'nullable'
        ]);

        $file = $request->file('berkas');

        list ($start, $end) = explode('-', $request->daterange);
        $startDate = str_replace("/","-",$start);
        $endDate = str_replace("/","-", $end);

        $fileName = date('Ymd-His')."_DATA_".date('jM', strtotime($startDate))."-".date('jM', strtotime($endDate)).".xlsx";
        //$path = $file->storeAs('public/berkas', $fileName);
        $path = Storage::disk('public')->putFileAs('berkas', $file, $fileName);


        $berkas = Berkas::create([
            'nama' => $fileName,
            'path' => $path,
            'tanggalMulaiPesanan' => $startDate,
            'tanggalAkhirPesanan' => $endDate
        ]);
        if(!empty($request->send)) {
            CreatePesananFromBerkas::dispatch($berkas->id, true);
        } else {
            CreatePesananFromBerkas::dispatch($berkas->id, false);
        }

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
        if(($berkas->berkasStatus == 2)||($berkas->berkasStatus == 4)) {
            Storage::disk('public')->delete($berkas->path);
            $berkas->delete();

            return redirect()
                ->route('admin.model.index', ['model' => 'berkas'])
                ->with(['status' => 'Berkas berhasil dihapus.']);
        } elseif (($berkas->berkasStatus == 1)||($berkas->berkasStatus == 3)) {
            return redirect()
                ->route('admin.model.index', ['model' => 'berkas'])
                ->with(['status' => 'Gagal. Berkas sedang diproses.']);
        } else {
            Storage::disk('public')->delete($berkas->path);
            $berkas->forceDelete();

            return redirect()
                ->route('admin.model.index', ['model' => 'berkas'])
                ->with(['status' => 'Berkas berhasil dihapus.']);
        }
    }
}
