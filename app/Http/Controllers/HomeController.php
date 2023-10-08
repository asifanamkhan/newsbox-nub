<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('back-end.dashboard');
    }
    public function home()
    {
        return view('front-end.home');
    }
    public function contact()
    {
//        return view('front-end.home');
    }

    public function about()
    {
//        return view('front-end.home');
    }

    public function gallery()
    {
//        return view('front-end.home');
    }

    public function events()
    {
//        return view('front-end.home');
    }

    public function achievement()
    {
//        return view('front-end.home');
    }

    public function allNews()
    {
//        return view('front-end.home');
    }

    public function singleNews()
    {
//        return view('front-end.home');
    }
}
