<?php

use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\servicesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoutingController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    // Route::get('', [RoutingController::class, 'index'])->name('root');
    // Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    // Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    // Route::get('{any}', [RoutingController::class, 'root'])->name('any');
});


// user view routes
Route::get('/',               [HomeController::class, 'index'])->name('home');
Route::get('/blog',           [HomeController::class, 'blog'])->name('blog');
Route::get('/blog-detail',    [HomeController::class, 'blogDetail'])->name('blog.detail');
Route::get('/services',       [HomeController::class, 'services'])->name('services.index');
Route::get('/service-detail', [HomeController::class, 'serviceDetail'])->name('service.detail');
Route::get('/projects',           [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}',    [ProjectController::class, 'show'])->name('projects.show');
Route::get('/hire-me',        [HomeController::class, 'hireMe'])->name('hire.me');




Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/projects',             [ProjectsController::class, 'index'])->name('admin.projects.index');
    Route::get('/project/create',       [ProjectsController::class, 'create'])->name('admin.project.create');
    Route::get('/project/edit/{id}',    [ProjectsController::class, 'edit'])->name('admin.project.edit');
    Route::post('/project/store',       [ProjectsController::class, 'store'])->name('admin.project.store');
    Route::put('/project/update/{id}',  [ProjectsController::class, 'update'])->name('admin.project.update');

    Route::get('/services',             [servicesController::class, 'index'])->name('admin.services.index');
});

