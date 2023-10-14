<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;



Route::get('/',[FrontendController::class,'home'])->name('home');
Route::post('newsletter',[NewsletterController::class,'store'])->name('newsletter.store');

Route::get('contact-us',[ContactController::class,'contactUs'])->name('contactUs');
Route::post('contact-create',[ContactController::class,'contactCreate'])->name('contact.create');

Route::get('type-wise-news-details/{type}',[FrontendController::class,'type_wise_news_details'])->name('type-wise-news-details');
Route::get('cat-wise-news-details/{id}',[FrontendController::class,'cat_wise_news_details'])->name('cat-wise-news-details');
Route::get('single-news-details/{id}',[FrontendController::class,'single_news_details'])->name('single-news-details');
