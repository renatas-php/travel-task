<?php

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

Route::get('/', function () {
    return view('front.index');
});
Route::get('/livewire', function () {
    return view('front.index-livewire');
});

Route::get('search', [\App\Http\Controllers\Travels\SearchController::class, 'index']);

Route::get('getCities/{id}', [\App\Http\Controllers\Travels\SearchController::class, 'getCities']);
