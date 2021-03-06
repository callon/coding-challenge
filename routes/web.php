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

Auth::routes(['register' => false]);

Route::get('/', function () {
    return redirect(route('login'));
});
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/projects', 'ProjectController')->only([
	'show', 'store', 'update', 'destroy'
]);;
Route::post('/projects/{project}/entries/start', 'EntryController@start');
Route::post('/projects/{project}/entries/stop', 'EntryController@stop');

Route::fallback(function(){
    return redirect('login');
});
