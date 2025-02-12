<?php

use App\Http\Controllers\TranscriptionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(TranscriptionController::class)->group(function () {
    Route::get('/transcription', 'create');
    Route::post('/transcription', 'store')->name('transcription.store');
});
