<?php

use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoutingController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::get('dashboard/', [RoutingController::class, 'index'])->name('root');
    Route::get('dashboard/{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('dashboard/{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    Route::get('dashboard/{any}', [RoutingController::class, 'root'])->name('any');
});


// user view routes
Route::get('/',               [HomeController::class, 'index'])->name('home');
Route::get('/blog',           [HomeController::class, 'blog'])->name('blog');
Route::get('/blog-detail',    [HomeController::class, 'blogDetail'])->name('blog.detail');
Route::get('/services',       [HomeController::class, 'services'])->name('services');
Route::get('/service-detail', [HomeController::class, 'serviceDetail'])->name('service.detail');
Route::get('/projects',           [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}',    [ProjectController::class, 'show'])->name('projects.show');
Route::get('/hire-me',        [HomeController::class, 'hireMe'])->name('hire.me');
