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
});

Route::get('/hasone', function () {
    $user = \App\User::first();
    return $user->role->name;
});

Route::get('/hasmany', function () {
    $role = \App\Role::first();
    return $role->user[0]->name;
});

Route::get('/isadmin', function () {
    $user = \App\User::first();
    return $user->isAdmin;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/spv', function () {
    return 'halo spv';
})->name('spv');
Route::get('/admin', function () {
    return 'halo admin';
})->name('admin');

