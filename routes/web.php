<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','verified'])->group(function(){
    Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
    Route::prefix('post')->name('post.')->controller(PostController::class)->group(function(){
        Route::get('/index','index')->name('index');
        Route::post('/store','store')->name('store');
        Route::get('/manage','manage')->name('manage');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::put('/update/{id}','update')->name('update');
        Route::get('/delete/{id}','delete')->name('delete');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
