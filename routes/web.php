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

//Auth::routes();
Route::get('signin', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('signin', 'Auth\LoginController@login')->name('login.post');
Route::post('signout', 'Auth\LoginController@logout')->name('logout');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

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

    Route::get('berkas/{id}/download', 'Model\BerkasController@download')->name('berkas.download');
});;
Route::prefix('spv')->group(function () {
    Route::get('/', 'SpvController@indexSpv')->name('spv.index');
});;

Route::prefix('profile')->group(function () {
    Route::get('/', 'Model\UserController@indexMe')->name('profile.index');
    Route::get('/edit', 'Model\UserController@indexEdit')->name('profile.edit');
    Route::get('/password', 'Model\UserController@indexUpdatePassword')->name('profile.password');
    Route::post('/password', 'Model\UserController@updateProfilePassword')->name('profile.password.update');
    Route::post('/update', 'Model\UserController@updateMe')->name('profile.update');
});;

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/excel/{id}', 'HomeController@excel')->name('excel');
Route::get('/donlot/{id}', 'HomeController@download')->name('donlot');


