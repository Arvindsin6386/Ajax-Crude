<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Faker\Guesser\Name;

Route::get('/', function () {
    return view('welcome');
});
// Route::view('/index','ajax');

Route::resource('employees', AdminController::class);