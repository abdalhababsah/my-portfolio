<?php

use App\Http\Controllers\Admin\ExperiencesController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\ProjectVideoController;
use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\servicesController;
use App\Http\Controllers\Frontend\ServiceController AS UserServicesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\RoutingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\CategoryController;
// use App\Http\Controllers\Admin\ProjectTechnologyController;
use App\Http\Controllers\Admin\SkillsController;
use App\Http\Controllers\Frontend\ContactController;

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
Route::post('/contact', [ContactController::class, 'store'])
     ->name('contact.store');



Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('projects', ProjectsController::class)->names('admin.projects');
    Route::resource('faqs', FaqsController::class)->names('admin.faqs');
    Route::resource('experiences', ExperiencesController::class)->names('admin.experiences');
    Route::resource('education', EducationController::class)->names('admin.education');
    Route::resource('certificates', CertificateController::class)->names( 'admin.certificates');
    Route::resource('categories', CategoryController::class)->names('admin.categories');
    Route::resource('skills', SkillsController::class)->names('admin.skills');
    Route::resource('project-videos', ProjectVideoController::class);
    // Route::resource('project-technology', ProjectTechnologyController::class);

    Route::get('/services',             [servicesController::class, 'index'])->name('admin.services.index');
});
