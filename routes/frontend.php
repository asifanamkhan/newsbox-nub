<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;



Route::get('/',[FrontendController::class,'home'])->name('home');
Route::post('newsletter',[NewsletterController::class,'store'])->name('newsletter.store');

Route::get('front-contact-create',[ContactController::class,'front_contact_create'])->name('front.contact.create');
