<?php
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');

Route::group(['as' => 'distributor.', 'prefix' => 'distributor'], function(){
    Route::get('index', 'DistributorController@index')->name('index');
    Route::post('ktable', 'DistributorController@ktable')->name('ktable');
    Route::get('show', 'DistributorController@show')->name('show');
    Route::post('store', 'DistributorController@store')->name('store');
    Route::get('edit/{dist_id}', 'DistributorController@edit')->name('edit');
    Route::post('update/{dist_id}', 'DistributorController@update')->name('update');
    route::post('delete/{dist_id}', 'DistributorController@delete')->name('delete');
});