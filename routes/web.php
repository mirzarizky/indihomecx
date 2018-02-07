<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/hasone', function () {
    $user = \App\User::first();
    return $user->role->name;
});

Route::get('/hasmany', function () {
    $role = \App\Role::first();
    return $role->user;
});


Route::get('/cabang', function () {
    $cabangs = \App\Cabang::where('kode', 'cne')->first();
    return $cabangs->pesanan;
})->name('cabang');


Auth::routes();


Route::get('/first', 'Model\UserController@firstLogin')->name('user.first');
Route::post('/first', 'Model\UserController@updatePassword')->name('user.updatePassword');


Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@indexAdmin')->name('admin.index');
    Route::get('/{model}/index', 'AdminController@index')->name('admin.model.index');
    Route::get('/{model}/form', 'AdminController@indexForm')->name('admin.model.form');
    Route::post('/{model}/create', 'AdminController@create')->name('admin.model.create');
    Route::get('/{model}/{id}/update', 'AdminController@indexUpdate')->name('admin.model.updateForm');
    Route::post('/{model}/{id}/update', 'AdminController@update')->name('admin.model.update');
    Route::get('/{model}/{id}/delete', 'AdminController@delete')->name('admin.model.delete');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/spv', function () {
    return 'halo spv';
})->name('spv');

