<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoutingController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    // Route::get('', [RoutingController::class, 'index'])->name('root');
    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    // Route::get('{any}', [RoutingController::class, 'root'])->name('any');
});


// user view routes
Route::get('/',               [HomeController::class, 'index'])->name('home');
Route::get('/blog',           [HomeController::class, 'blog'])->name('blog');
Route::get('/blog-detail',    [HomeController::class, 'blogDetail'])->name('blog.detail');
Route::get('/services',       [HomeController::class, 'services'])->name('services');
Route::get('/service-detail', [HomeController::class, 'serviceDetail'])->name('service.detail');
Route::get('/portfolio',      [HomeController::class, 'portfolio'])->name('portfolio');
Route::get('/portfolio-detail',[HomeController::class, 'portfolioDetail'])->name('portfolio.detail');
Route::get('/hire-me',        [HomeController::class, 'hireMe'])->name('hire.me');