<?php

namespace App\Http\Controllers\Model;

use App\Kriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KriteriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $allKriteria = Kriteria::all();
        return view('admin.kriteria.index', compact('allKriteria'));
    }

    public function indexForm() {
        return view('admin.kriteria.form');
    }

    public function create(Request $request) {

        $request->validate([
            'nama' => 'required|string|unique:kriteria|max:255',
        ]);

        Kriteria::create([
            'nama' => $request->nama,
        ]);
        return redirect()
            ->route('admin.model.index', ['model' => 'kriteria'])
            ->with(['status' => 'Kriteria berhasil ditambahkan!']);
    }

    public function updateForm($id) {
        $kriteria = Kriteria::FindOrFail($id);

        return view('admin.kriteria.updateform', compact('kriteria'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Kriteria::where('id', $id)
            ->update([
                'nama' => $request->nama,
            ]);

        return redirect()
            ->route('admin.model.index', ['model' => 'kriteria'])
            ->with(['status' => 'Kriteria berhasil diperbaharui!']);
    }

    public function delete($id)
    {
        Kriteria::destroy($id);

        return redirect()
            ->route('admin.model.index', ['model' => 'kriteria'])
            ->with(['status' => 'Kriteria berhasil dihapus!']);
    }
}
