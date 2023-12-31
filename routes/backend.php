<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\news\NewsCategoryController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\News\NewsTypeController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\settings\AboutController;
use App\Http\Controllers\settings\GeneralSettingController;
use App\Http\Controllers\settings\ImportantLinkController;
use App\Http\Controllers\settings\SocialLinkController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ReadersController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::resource('general-settings',GeneralSettingController::class);
Route::resource('about-us',AboutController::class);
Route::resource('social-link',SocialLinkController::class);
Route::resource('slides',SliderController::class);
Route::resource('important-links',ImportantLinkController::class);
Route::resource('category',NewsCategoryController::class);
Route::resource('newstype', NewsTypeController::class);
Route::resource('events',EventController::class);
Route::resource('achievements',AchievementController::class);
Route::resource('news',NewsController::class);
Route::resource('gallery',GalleryController::class);
Route::resource('ads',AdController::class);
Route::resource('readers',ReadersController::class);
Route::resource('permissions',PermissionController::class);
Route::resource('roles',RoleController::class);
Route::resource('users',UserController::class);
Route::resource('notice',NoticeController::class);



Route::get('contactus',[ContactController::class,'index'])->name('contactus.index');
Route::get('newsletter',[\App\Http\Controllers\NewsletterController::class,'index'])->name('newsletter.index');


Route::get('slide-status-change',[SliderController::class,'slide_status_change'])->name('slide-status-change');
Route::get('add-news-to-slides-modal',[SliderController::class,'add_news_to_slides_modal'])->name('add-news-to-slides-modal');
Route::get('add-news-to-slide',[SliderController::class,'add_news_to_slide'])->name('add-news-to-slide');

Route::get('events-status-change',[EventController::class,'events_status_change'])->name('events-status-change');
Route::get('achievements-status-change',[AchievementController::class,'achievements_status_change'])->name('achievements-status-change');
Route::get('slide-status-news',[NewsController::class,'news_status_change'])->name('news-status-change');

Route::get('featured-slides',[SliderController::class,'featured_slides_index'])->name('featured-slides.index');
Route::get('news-add-to-featured-slide/{news_id}',[SliderController::class,'news_add_to_featured_slide'])->name('news-add-to-featured-slide');
Route::get('news-remove-from-featured-slide/{news_id}',[SliderController::class,'news_remove_from_featured_slide'])->name('news-remove-from-featured-slide');

Route::get('news-add-to-slide/{news_id}/{slide_id}',[SliderController::class,'news_add_to_slide'])->name('news-add-to-slide');

Route::get('gallery-status-change',[GalleryController::class,'gallery_status_change'])->name('gallery-status-change');
Route::post('add-new-image-gallery',[GalleryController::class,'add_new_image_gallery'])->name('add-new-image-gallery');

Route::get('ads-status-change',[AdController::class,'ads_status_change'])->name('ads-status-change');

Route::get('notice-status-change',[NoticeController::class,'notice_status_change'])->name('notice-status-change');



