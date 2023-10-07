<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;


Route::get('/', function () {
    return view('front-end.home');
});
Route::post('newsletter',[NewsletterController::class,'store'])->name('newsletter.store');
