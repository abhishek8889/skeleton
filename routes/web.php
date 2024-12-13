<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\CategoryController;
// use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\AppSettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('categories',[CategoryController::class,'index'])->name('categories');
    Route::get('category/add',[CategoryController::class,'addCategory'])->name('categories.add');
    Route::post('category-store',[CategoryController::class,'store'])->name('categories.store');
    
    //
    Route::get('posts',[PostController::class ,'index'])->name('posts'); 
    Route::get('posts/create',[PostController::class ,'create'])->name('posts.create'); 
    Route::post('posts/store',[PostController::class ,'store'])->name('posts.store'); 
    Route::post('posts/remove/{id}',[PostController::class ,'delete'])->name('posts.remove'); 
    Route::get('posts/update/{id}',[PostController::class ,'update'])->name('posts.update'); 

    // :::::::::: App Settings ::::::::::
    
    Route::prefix('settings')->controller(AppSettingsController::class)->group(function(){
        Route::get('/','index')->name('settings.index');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
