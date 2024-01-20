<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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
    return view('home');
});

Route::post('/store', [StudentController::class, 'store'])->name('store');
Route::get('/fetchall', [StudentController::class, 'fetchAll'])->name('fetchAll');
Route::get('/edit', [StudentController::class, 'edit'])->name('edit');
Route::post('/update', [StudentController::class, 'update'])->name('update');
Route::delete('/delete', [StudentController::class, 'delete'])->name('delete');
