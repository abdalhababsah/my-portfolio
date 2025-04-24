<?php

use App\Http\Controllers\Admin\ExperiencesController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\servicesController;
use App\Http\Controllers\Frontend\ServiceController as UserServicesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\RoutingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProjectImageController;
use App\Http\Controllers\Admin\ProjectTechnologyController;
use App\Http\Controllers\Admin\SkillsController;

require __DIR__ . '/auth.php';
Route::get('/lang/{locale}', [LocalizationController::class, 'switchLang'])->name('locale.switch');

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
Route::get('/services',       [UserServicesController::class, 'index'])->name('services.index');
Route::get('/services',       [UserServicesController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [UserServicesController::class, 'show'])->name('services.show');
Route::get('/service-detail', [HomeController::class, 'serviceDetail'])->name('service.detail');
Route::get('/projects',           [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}',    [ProjectController::class, 'show'])->name('projects.show');




Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('projects', ProjectsController::class);
    Route::resource('faqs', FaqsController::class);
    Route::resource('experiences', ExperiencesController::class);
    Route::resource('education', EducationController::class);
    Route::resource('certificates', CertificateController::class)->names('certificates');
    Route::resource('categories', CategoryController::class)->names('categories');
    Route::resource('skills', SkillsController::class)->names('skills');
    Route::resource('project-videos', \App\Http\Controllers\Admin\ProjectVideoController::class);
    Route::resource('project-images', \App\Http\Controllers\Admin\ProjectImageController::class)->names('project-images');
    Route::resource('service-images', \App\Http\Controllers\Admin\ServiceImageController::class)->names('service-images');
    Route::resource('tags', \App\Http\Controllers\Admin\TagController::class)->names('tags');
    Route::resource('social-links', \App\Http\Controllers\Admin\SocialLinkController::class)->names('social-links');
    Route::resource('technologies', \App\Http\Controllers\Admin\TechnologyController::class)->names('technologies');
    Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);
    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class)->names('blogs');

    Route::resource('services', ServicesController::class)->names('services');
});
