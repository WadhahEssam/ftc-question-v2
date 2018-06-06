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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('main');
});

Route::post('/loginAdmin' , 'Controller@loginAdmin') ;

// todo : this should be removed after production
Route::get('/testAdmin' , function(){
    return view('admin') ;
});

Route::get('/admin' , 'Controller@showAdminPage' )->name('admin') ;

Route::post('/changeAdminPassword' , 'Controller@changeAdminPassword') ;