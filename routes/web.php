<?php

use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    'login'    => true,
    'logout'   => true,
    'register' => true,
    'reset'    => false,
    'confirm'  => false ,
    'verify'   => false
]);

Route::get('/'     , [HomeController::class, 'index'])->name('home');
Route::get('/home' , [HomeController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function (){

    Route::get('my-tasks', [TaskController::class, 'userTasks'])->name('me.tasks');

    Route::middleware('is_admin')->as('admin.')->prefix('admin')->group(function (){
       Route::resource('tasks', TaskController::class)->only('index', 'create', 'store');
        Route::get('statistics', [TaskController::class, 'statistics'])->name('statistics');

    });
});
