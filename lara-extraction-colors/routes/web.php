<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\ImageExtractColorController;

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

Route::get('upload-file',  'UploadFileController@index')->name('image.index');
Route::post('upload-file',  'UploadFileController@store' )->name('image.save');
Route::get('colors-extraction/{id}',  'ColorsExtractionController@extractColors' )->name('image.colors-extraction');