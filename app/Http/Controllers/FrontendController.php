<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function home()
    {
        $general_settings = DB::table('general_settings')->first();
        $news_categories = DB::table('news_categories')->first();
        return view('front-end.home',compact('general_settings','news_categories'));
    }
}
