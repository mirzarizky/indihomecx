<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Model\CabangController;
use App\Http\Controllers\Model\UserController;
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
        return view('admin.index');
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
            default :
                return redirect()->back();
                break;
        }
    }
}
