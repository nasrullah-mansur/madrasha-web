<?php

use App\Http\Controllers\Front\FrontController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontController::class, 'index'])->name('welcome');
Route::get('/division/{slug}', [FrontController::class, 'division_view'])->name('division.view');

Route::get('/gallery', [FrontController::class, 'gallery'])->name('front.gallery');

Route::get('contact', [FrontController::class, 'contact'])->name('front.contact');

// Custom page;
Route::get('/page/{slug}', [FrontController::class, 'custom_page'])->name('custom.page.view');

// Contact;
Route::post('contact-form', [FrontController::class, 'contact_form'])->name('contact.form');
