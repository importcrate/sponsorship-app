<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SponsorshipApplicationController;
use App\Http\Controllers\AdminSponsorshipController;
use App\Models\Announcement;
use App\Http\Controllers\AnnouncementController;

/* Route::get('/', function () {
    return view('welcome');
}); */

// Homepage route
//Route::get('/', [SponsorshipApplicationController::class, 'create'])->name('sponsorship.apply');

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/dashboard', function () {
    $announcement = Announcement::latest()->first(); // just get 1 for now
    return view('dashboard', compact('announcement'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/announcement/update', [AnnouncementController::class, 'update'])->name('announcement.update');
});

// Sponsorship application routes
Route::post('/sponsorship/apply', [SponsorshipApplicationController::class, 'store'])
    ->middleware([
        \App\Http\Middleware\HoneypotMiddleware::class,
        'throttle:5,1', // Allow max 5 submissions per minute per IP
    ])
    ->name('sponsorship.store');

Route::get('/sponsorship/apply', [SponsorshipApplicationController::class, 'create'])->name('sponsorship.apply');


// Admin-only sponsorship management routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/sponsorships', [AdminSponsorshipController::class, 'index'])->name('admin.sponsorships.index');
    Route::get('/admin/sponsorships/{id}', [AdminSponsorshipController::class, 'show'])->name('admin.sponsorships.show');
    Route::post('/admin/sponsorships/{id}/approve', [AdminSponsorshipController::class, 'approve'])->name('admin.sponsorships.approve');
    Route::post('/admin/sponsorships/{id}/deny', [AdminSponsorshipController::class, 'deny'])->name('admin.sponsorships.deny');
});


require __DIR__.'/auth.php';
