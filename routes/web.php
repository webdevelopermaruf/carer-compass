<?php

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// public pages
Route::get('/', [SiteController::class, 'index']);  // Home Pages
Route::get('/search', [SiteController::class, 'search']); // Search Pages
Route::get('/profile/{id}', [SiteController::class, 'profile']); // Individual Page

Route::get('/login', [SiteController::class, 'login'])->name('login'); // Login Page
Route::post('/login', [SiteController::class, 'handleLogin']); // Handle Role Based Login

Route::get('/dashboard', [SiteController::class, 'dashboard'])->middleware('auth'); // System Administrator Dashboard
Route::get('/update_status', [SiteController::class, 'update_status'])->middleware('auth'); // Approval/ Rejection handle

Route::get('/register-as-carer', [SiteController::class, 'carer']); // Register as a carer Page
Route::post('/register-as-carer', [SiteController::class, 'register_carer']); // Handle Registration of Carer

Route::get('/register-as-parent', [SiteController::class, 'parent']);// Register as a parent Page
Route::post('/register-as-parent', [SiteController::class, 'register_parent']);// Handle Registration of Parent

// can leave a review when you've logged in as a parent.
Route::post('/leave-review/{carer}', [ReviewController::class, 'leave_review'])->middleware('auth:parent');


Route::get('/logout', [SiteController::class, 'logout']); // Logout of all sessions




