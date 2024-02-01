<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\LeadDeveloperController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\OwnerController;

// Owner Routes
Route::prefix('owner')->group(function () {

    Route::get('/loginform', [OwnerController::class, 'loginForm'])->name('owner.loginForm');
    Route::post('/login', [OwnerController::class, 'login'])->name('owner.login');
    Route::get('/logout', [OwnerController::class, 'logout'])->name('owner.logout')->middleware('owner');
    Route::get('/registerForm', [OwnerController::class, 'registerForm'])->name('owner.registerForm');
    Route::post('/register', [OwnerController::class, 'register'])->name('owner.register');

    Route::middleware('owner')->group(function () {
        Route::get('/projects', [OwnerController::class, 'index'])->name('owner_projects');
        Route::get('/create', [OwnerController::class, 'create'])->name('owner.projects.create');
        Route::post('/project/store', [OwnerController::class, 'store'])->name('owner.projects.store');
    });
});

// Manager Routes
Route::prefix('manager')->group(function () {

    Route::get('/loginform', [ManagerController::class, 'loginForm'])->name('manager.loginForm');
    Route::post('/login', [ManagerController::class, 'login'])->name('manager.login');
    Route::get('/logout', [ManagerController::class, 'logout'])->name('manager.logout')->middleware('manager');
    Route::get('/registerForm', [ManagerController::class, 'registerForm'])->name('manager.registerForm');
    Route::post('/register', [ManagerController::class, 'register'])->name('manager.register');

    Route::middleware('manager')->group(function () {
        Route::get('/projects', [ManagerController::class, 'index'])->name('manager_projects');
        Route::get('/projects/request', [ManagerController::class, 'showrequest'])->name('manager_projects_request');
        Route::put('/projects/{project}/approve', [ManagerController::class, 'approve'])->name('manager.projects.approve');
        Route::get('/project/{project}', [ManagerController::class, 'show'])->name('manager_project');
        Route::post('/project/store', [ManagerController::class, 'store'])->name('manager_project_store');
        Route::get('/edit/{project}', [ManagerController::class, 'edit'])->name('manager_project_edit');
        Route::patch('/{project}', [ManagerController::class, 'update'])->name('manager_project_update');
        Route::delete('/{project}', [ManagerController::class, 'destroy'])->name('manager_project_destroy');
        Route::get('/projects/{project}/progresses', [ManagerController::class, 'showProjectProgresses'])
            ->name('manager.projects.progresses');
    });
});

// Lead Developer Routes

Route::prefix('lead_developer')->group(function () {

    Route::get('/loginform', [LeadDeveloperController::class, 'loginForm'])->name('leadDev.loginForm');
    Route::post('/login', [LeadDeveloperController::class, 'login'])->name('leadDev.login');
    Route::get('/logout', [LeadDeveloperController::class, 'logout'])->name('leadDev.logout')->middleware('lead_developer');
    Route::get('/registerForm', [LeadDeveloperController::class, 'registerForm'])->name('leadDev.registerForm');
    Route::post('/register', [LeadDeveloperController::class, 'register'])->name('leadDev.register');
    // Add more lead developer-specific routes as needed
    Route::middleware('lead_developer')->group(function () {
        Route::get('/project/{project}', [LeadDeveloperController::class, 'show'])->name('leadDev_project');
        Route::get('/projects', [LeadDeveloperController::class, 'index'])->name('lead_developer.projects.index');
        Route::get('/projects/{project}/create-progress', [LeadDeveloperController::class, 'createProgressForm'])
            ->name('lead_developer.progress.create');
        Route::post('/projects/{project}/store-progress', [LeadDeveloperController::class, 'storeProgress'])
            ->name('lead_developer.progress.store');
        Route::post('/project/assign-lead-developer/{project}', [ManagerController::class, 'assignLeadDeveloper'])
            ->name('assignLeadDeveloper');
        Route::post('/project/unassign-lead-developer/{project}', [ManagerController::class, 'unassignLeadDeveloper'])
            ->name('unassignLeadDeveloper');
        Route::post('/project/assign-developer/{project}', [ManagerController::class, 'assignDeveloper'])
            ->name('assignDeveloper');
        Route::post('/project/unassign-all-developers/{project}', [ManagerController::class, 'unassignAllDevelopers'])
            ->name('unassignAllDevelopers');
    });
});


// Other Routes
Route::resource('developer', DeveloperController::class);

// Authentication Routes
Auth::routes();

// Home Route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Welcome Route
Route::get('/', function () {
    return view('welcome');
});
