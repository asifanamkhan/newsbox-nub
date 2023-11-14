<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function home()
    {
        $news_categories = DB::table('news_categories')->first();
        return view('front-end.home',compact('news_categories'));
    }

    public function type_wise_news_details($type)
    {
        $latest_news = \Illuminate\Support\Facades\DB::table('news')
            ->where('news.type',$type)
            ->leftjoin('news_categories', 'news.category_id', '=', 'news_categories.id')
            ->orderBy('news.id', 'DESC')
            ->select(['news.*','news_categories.name as news_cat_name'])
            ->get();

        return view('front-end.pages.news.type-wise-details', compact('latest_news'));
    }

    public function cat_wise_news_details($id)
    {
        $news = \Illuminate\Support\Facades\DB::table('news')
            ->where('news.category_id',$id)
            ->leftjoin('news_categories', 'news.category_id', '=', 'news_categories.id')
            ->orderBy('news.id', 'DESC')
            ->select(['news.*','news_categories.name as news_cat_name'])
            ->get();

        return view('front-end.pages.news.category-wise-details', compact('news'));
    }
    public function single_news_details($id)
    {
        $news = \Illuminate\Support\Facades\DB::table('news')
            ->where('news.id',$id)
            ->leftjoin('news_categories', 'news.category_id', '=', 'news_categories.id')
            ->orderBy('news.id', 'DESC')
            ->select(['news.*','news_categories.name as news_cat_name'])
            ->first();

        return view('front-end.pages.news.single-news', compact('news'));
    }


    public function about_us()
    {
      
        return view('front-end.pages.about-us.index');
    }

    public function news_search(Request $request){
        ;
        $news = \Illuminate\Support\Facades\DB::table('news')
            ->where('news.description', 'like', "%$request->search%")
            ->orWhere('news.title', 'like', "%$request->search%")
            ->leftjoin('news_categories', 'news.category_id', '=', 'news_categories.id')
            ->orderBy('news.id', 'DESC')
            ->select(['news.*','news_categories.name as news_cat_name'])
            ->get();

        return view('front-end.pages.news.category-wise-details', compact('news'));
    }

    
    


}
