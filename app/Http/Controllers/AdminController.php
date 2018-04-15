<?php

namespace App\Http\Controllers;

use App\Berkas;
use App\Cabang;
use App\Http\Controllers\Model\BerkasController;
use App\Http\Controllers\Model\CabangController;
use App\Http\Controllers\Model\KriteriaController;
use App\Http\Controllers\Model\UserController;
use App\Http\Controllers\Model\PesananController;
use App\Pesanan;
use App\Survei;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
    $this->middleware('isAdmin');
    $this->middleware('isDefaultPassword');
}

    public function indexAdmin()
    {
        $totalUsers = User::all()->count();
        $totalCabang = Cabang::all()->count();
        $totalSurvei = Survei::all()->count();
        $totalBerkas = Berkas::all()->count();
        $totalOrderThisWeek = Pesanan::whereBetween('tanggal', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->count();
        $count = array(
            'users' => $totalUsers,
            'cabang' => $totalCabang,
            'orders' => $totalOrderThisWeek,
            'survei' => $totalSurvei,
            'berkas' => $totalBerkas
        );
        return view('admin.index', compact('count'));
    }

    public function index($model)
    {
        switch ($model) {
            case 'sto' :
                $cabangController = new CabangController();
                return $cabangController->index();
                break;
            case 'user' :
                $userController = new UserController();
                return $userController->index();
                break;
            case 'kriteria' :
                $kriteriaController = new KriteriaController();
                return $kriteriaController->index();
                break;
            case 'berkas' :
                $berkasController = new BerkasController();
                return $berkasController->index();
                break;
            case 'order' :
                $pesananController = new PesananController();
                return $pesananController->index();
                break;
            default :
                return redirect()->route('admin.index');
                break;
        }
    }

    public function indexForm($model)
    {
        switch ($model) {
            case 'sto' :
                $cabangController = new CabangController();
                return $cabangController->indexForm();
                break;
            case 'user' :
                $userController = new UserController();
                return $userController->indexForm();
                break;
            case 'kriteria' :
                $kriteriaController = new KriteriaController();
                return $kriteriaController->indexForm();
                break;
            case 'berkas' :
                $berkasController = new BerkasController();
                return $berkasController->indexForm();
                break;
            default :
                return redirect()->back();
                break;
        }
    }

    public function create(Request $request, $model)
    {
        switch ($model) {
            case 'sto' :
                $cabangController = new CabangController();
                return $cabangController->create($request);
                break;
            case 'user' :
                $userController = new UserController();
                return $userController->create($request);
                break;
            case 'kriteria' :
                $kriteriaController = new KriteriaController();
                return $kriteriaController->create($request);
                break;
            case 'berkas' :
                $berkasController = new BerkasController();
                return $berkasController->create($request);
                break;
            default :
                return redirect()->back();
                break;
        }
    }

    public function indexUpdate($model, $id)
    {
        switch ($model) {
            case 'sto' :
                $cabangController = new CabangController();
                return $cabangController->updateForm($id);
                break;
            case 'user' :
                $userController = new UserController();
                return $userController->updateForm($id);
                break;
            case 'kriteria' :
                $kriteriaController = new KriteriaController();
                return $kriteriaController->updateForm($id);
                break;
            case 'berkas' :
                $berkasController = new BerkasController();
                return $berkasController->updateForm($id);
                break;
            default :
                return redirect()->back();
                break;
        }
    }

    public function update(Request $request, $model, $id)
    {
        switch ($model) {
            case 'sto' :
                $cabangController = new CabangController();
                return $cabangController->update($request, $id);
                break;
            case 'user' :
                $userController = new UserController();
                return $userController->update($request, $id);
                break;
            case 'kriteria' :
                $kriteriaController = new KriteriaController();
                return $kriteriaController->update($request, $id);
                break;
            case 'berkas' :
                $berkasController = new BerkasController();
                return $berkasController->update($request, $id);
                break;
            default :
                return redirect()->back();
                break;
        }
    }

    public function delete($model, $id)
    {
        switch ($model) {
            case 'sto' :
                $cabangController = new CabangController();
                return $cabangController->delete($id);
                break;
            case 'user' :
                $userController = new UserController();
                return $userController->delete($id);
                break;
            case 'kriteria' :
                $kriteriaController = new KriteriaController();
                return $kriteriaController->delete($id);
                break;
            case 'berkas' :
                $berkasController = new BerkasController();
                return $berkasController->delete($id);
                break;
            default :
                return redirect()->back();
                break;
        }
    }
}
