<?php

use App\Http\Controllers\settings\AboutController;
use App\Http\Controllers\settings\GeneralSettingController;
use App\Http\Controllers\settings\SocialLinkController;
use App\Http\Controllers\settings\SliderController;
use Illuminate\Support\Facades\Route;

Route::resource('general-settings',GeneralSettingController::class);
Route::resource('about-us',AboutController::class);
Route::resource('social-link',SocialLinkController::class);
Route::resource('slides',SliderController::class);