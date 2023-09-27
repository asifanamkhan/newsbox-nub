<?php

use App\Http\Controllers\settings\AboutController;
use App\Http\Controllers\settings\GeneralSettingController;
use App\Http\Controllers\settings\SocialLinkController;
use App\Http\Controllers\settings\SliderController;
use App\Http\Controllers\settings\ImportantLinkController;
use App\Http\Controllers\news\NewsCategoryController;
use App\Http\Controllers\AchivementController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::resource('general-settings',GeneralSettingController::class);
Route::resource('about-us',AboutController::class);
Route::resource('social-link',SocialLinkController::class);
Route::resource('slides',SliderController::class);
Route::resource('important-links',ImportantLinkController::class);
Route::resource('category',NewsCategoryController::class);
Route::resource('events',EventController::class);
Route::resource('achivements',AchivementController::class);


Route::get('slide-status-change',[SliderController::class,'slide_status_change'])->name('slide-status-change');



