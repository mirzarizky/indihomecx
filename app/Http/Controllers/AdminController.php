<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Model\CabangController;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function index($model)
    {
        switch ($model) {
            case 'sto' :
                $cabangController = new CabangController();
                return $cabangController->index();
                break;
            default :
                return redirect()->back();
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
            default :
                return redirect()->back();
                break;
        }
    }
}
