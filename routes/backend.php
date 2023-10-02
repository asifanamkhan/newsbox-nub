<?php

use App\Http\Controllers\settings\AboutController;
use App\Http\Controllers\settings\GeneralSettingController;
use App\Http\Controllers\settings\SocialLinkController;
use App\Http\Controllers\settings\SliderController;
use App\Http\Controllers\settings\ImportantLinkController;
use App\Http\Controllers\news\NewsCategoryController;
use App\Http\Controllers\AchievementController ;
use App\Http\Controllers\GalleryController ;
use App\Http\Controllers\EventController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::resource('general-settings',GeneralSettingController::class);
Route::resource('about-us',AboutController::class);
Route::resource('social-link',SocialLinkController::class);
Route::resource('slides',SliderController::class);
Route::resource('important-links',ImportantLinkController::class);
Route::resource('category',NewsCategoryController::class);
Route::resource('events',EventController::class);
Route::resource('achievements',AchievementController::class);
Route::resource('news',NewsController::class);
Route::resource('gallery',GalleryController::class);


Route::get('contactus',[ContactController::class,'index'])->name('contactus.index');
Route::get('newsletter',[\App\Http\Controllers\NewsletterController::class,'index'])->name('newsletter.index');


Route::get('slide-status-change',[SliderController::class,'slide_status_change'])->name('slide-status-change');
Route::get('events-status-change',[EventController::class,'events_status_change'])->name('events-status-change');
Route::get('achievements-status-change',[AchievementController::class,'achievements_status_change'])->name('achievements-status-change');




