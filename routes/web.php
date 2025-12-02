<?php

use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\TechStackController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\PortfolioController;
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

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');

    Route::post('/tech-stack/reorder', [TechStackController::class, 'reorder'])->name('tech-stack.reorder');
    Route::resource('tech-stack', TechStackController::class)->except(['show']);

    // Tag routes
    Route::resource('tags', TagController::class)->except(['show']);

    // Project routes
    Route::post('/projects/reorder', [ProjectController::class, 'reorder'])->name('projects.reorder');
    Route::delete('/projects/images/{imageId}', [ProjectController::class, 'deleteImage'])->name('projects.delete-image');
    Route::post('/projects/{project}/images/reorder', [ProjectController::class, 'reorderImages'])->name('projects.reorder-images');
    Route::resource('projects', ProjectController::class)->except(['show']);
});
