<?php

use App\Http\Controllers\Admin\ExperiencesController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\servicesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoutingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProjectTechnologyController;
use App\Http\Controllers\Admin\SkillsController;

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
    Route::resource('projects', ProjectsController::class);
    Route::resource('faqs', FaqsController::class);
    Route::resource('experiences', ExperiencesController::class);
    Route::resource('education', EducationController::class);
    Route::resource('certificates', CertificateController::class)->names('certificates');
    Route::resource('categories', CategoryController::class)->names('categories');
    Route::resource('skills', SkillsController::class)->names('skills');
    Route::resource('project-videos', \App\Http\Controllers\Admin\ProjectVideoController::class);
    Route::resource('project-technology', ProjectTechnologyController::class);

    Route::get('/services',             [servicesController::class, 'index'])->name('admin.services.index');
});
