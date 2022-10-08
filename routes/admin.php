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
    Route::group(['namespace' => 'Admin',
                  'prefix'  =>  'admin',
                  'as' => 'admin.'
                 ], function () {

        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login')->name('login.post');
        Route::get('logout', 'LoginController@logout')->name('logout');

        Route::middleware(['auth:admin'])->group(function (){
            Route::get('/', function () {
                return view('admin.dashboard.index');
            })->name('dashboard');

            Route::get('/settings', 'SettingController@index')->name('settings');
            Route::post('/settings', 'SettingController@update')->name('settings.update');

            Route::group(['prefix' => 'categories', 'as' => 'categories.'], function() {

                Route::get('/', 'CategoryController@index')->name('index');
                Route::get('/create', 'CategoryController@create')->name('create');
                Route::post('/store', 'CategoryController@store')->name('store');
                Route::get('/{id}/edit', 'CategoryController@edit')->name('edit');
                Route::post('/update', 'CategoryController@update')->name('update');
                Route::get('/{id}/delete', 'CategoryController@delete')->name('delete');

            });

            Route::group(['prefix'  =>   'attributes', 'as' => 'attributes.'], function() {
                Route::get('/', 'AttributeController@index')->name('index');
                Route::get('/create', 'AttributeController@create')->name('create');
                Route::get('/{id}/edit', 'AttributeController@edit')->name('edit');
                Route::post('/store', 'AttributeController@store')->name('store');
                Route::post('/update', 'AttributeController@update')->name('update');
                Route::get('/{id}/delete', 'AttributeController@delete')->name('delete');

            });

            Route::group(['prefix' => 'brands',  'as' => 'brands.'], function() {
                Route::get('/', 'BrandController@index')->name('index');
                Route::get('/create', 'BrandController@create')->name('create');
                Route::post('/store', 'BrandController@store')->name('store');
                Route::get('/{id}/edit', 'BrandController@edit')->name('edit');
                Route::post('/update', 'BrandController@update')->name('update');
                Route::get('/{id}/delete', 'BrandController@delete')->name('delete');

            });

            Route::group(['prefix' => 'products', 'as' => 'products.'], function () {

                Route::get('/', 'ProductController@index')->name('index');
                Route::get('/create', 'ProductController@create')->name('create');
                Route::post('/store', 'ProductController@store')->name('store');
                Route::get('/edit/{id}', 'ProductController@edit')->name('edit');
                Route::post('/update', 'ProductController@update')->name('update');

                Route::post('images/upload', 'ProductImageController@upload')->name('images.upload');
                Route::get('images/{id}/delete', 'ProductImageController@delete')->name('images.delete');

            });

            Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
                Route::get('/', 'OrderController@index')->name('index');
                Route::get('/{order}/show', 'OrderController@show')->name('show');
            });
        });

    });
