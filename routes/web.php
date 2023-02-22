<?php

use App\Http\Controllers\Admin\NoteController;
use Illuminate\Support\Facades\File;
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

// Route::any('/', function () {
//     return File::get(public_path() . '/index.html' );
// });


Route::any('/{any?}', function () {
    return File::get(public_path() . '/app/index.html' );
})->where('any', '.*');
