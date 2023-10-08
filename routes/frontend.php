<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\HomeController;


//Route::get('/', function () {
//    return view('front-end.home');
//});
Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/contactus',[HomeController::class,'contact'])->name('home.contact');
Route::get('/aboutus',[HomeController::class,'about'])->name('home.about');
Route::get('/gallery',[HomeController::class,'gallery'])->name('home.gallery');
Route::get('/events',[HomeController::class,'events'])->name('home.events');
Route::get('/achievement',[HomeController::class,'achievement'])->name('home.achievement');
Route::get('/allNews/id',[HomeController::class,'allNews'])->name('home.allNews');
Route::get('/singleNews/id',[HomeController::class,'singleNews'])->name('home.singleNews');


Route::post('newsletter',[NewsletterController::class,'store'])->name('newsletter.store');
