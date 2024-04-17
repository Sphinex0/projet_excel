<?php

use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('import');
});
Route::post('/post', [ImportController::class, "store"])->name("store");
