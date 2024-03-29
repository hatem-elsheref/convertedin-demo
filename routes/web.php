<?php

use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\HomeController;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::middleware(['auth'])->group(function (){

    Route::get('my-tasks', [TaskController::class, 'userTasks']);

    Route::middleware('is_admin')->prefix('admin')->group(function (){
       Route::resource('tasks', TaskController::class)->except('show');
    });
});
