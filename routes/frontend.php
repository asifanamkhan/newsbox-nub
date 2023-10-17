<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AchievementController;


Route::get('/',[FrontendController::class,'home'])->name('home');
Route::post('newsletter',[NewsletterController::class,'store'])->name('newsletter.store');

Route::get('contact-us',[ContactController::class,'contactUs'])->name('contactUs');
Route::post('contact-create',[ContactController::class,'contactCreate'])->name('contact.create');

Route::get('type-wise-news-details/{type}',[FrontendController::class,'type_wise_news_details'])->name('type-wise-news-details');
Route::get('cat-wise-news-details/{id}',[FrontendController::class,'cat_wise_news_details'])->name('cat-wise-news-details');
Route::get('single-news-details/{id}',[FrontendController::class,'single_news_details'])->name('single-news-details');

Route::get('about-us',[FrontendController::class,'about_us'])->name('about-us');
Route::get('gallery',[GalleryController::class,'gallery'])->name('gallery');
Route::get('gallery-details/{id}',[GalleryController::class,'gallery_details'])->name('gallery-details');

Route::get('events',[EventController::class,'events'])->name('events');
Route::get('events-details/{id}',[EventController::class,'events_details'])->name('events-details');


Route::get('achievements',[AchievementController::class,'achievements'])->name('achievements');
Route::get('achievements-details/{id}',[AchievementController::class,'achievements_details'])->name('achievements-details');
