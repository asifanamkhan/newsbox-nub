<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SocialLinkController;

Route::resource('general-settings',GeneralSettingController::class);
Route::resource('about-us',AboutController::class);
Route::resource('social-link',SocialLinkController::class);