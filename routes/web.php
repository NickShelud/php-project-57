<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskStatusesController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\LabelController;
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
    return view('mainWelcome');
})->name('welcome');

Route::resource('task_statuses', TaskStatusesController::class);
Route::resource('tasks', TasksController::class);
Route::resource('labels', LabelController::class);

require __DIR__ . '/auth.php';
