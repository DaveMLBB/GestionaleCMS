<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;



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
    return view('welcome');
});


// Prefisso per tutte le route relative alla creazione di progetti
Route::prefix('project-creator')->group(function () {
    Route::get('/create', [ProjectController::class, 'createNewProject'])->name('createNewProject');
});