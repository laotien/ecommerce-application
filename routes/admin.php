<?php

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    Route::group(['middleware' => ['auth:admin'],
                  'namespace' => 'Admin',
                  'prefix'  =>  'admin',
                  'as' => 'admin.'], function () {

        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login')->name('login.post');
        Route::get('logout', 'LoginController@logout')->name('logout');

        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('dashboard');


    });