<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;



Route::get('/',[FrontendController::class,'home'])->name('home');
Route::post('newsletter',[NewsletterController::class,'store'])->name('newsletter.store');

Route::get('contactUs',[ContactController::class,'contactUs'])->name('contactUs');
Route::post('contact-create',[ContactController::class,'contactCreate'])->name('contact.create');
