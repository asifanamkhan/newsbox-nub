<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $slides = DB::table('sliders')->first();
            return view('back-end.settings.slide.index', compact('slides'));
        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if($request->slide){
            $position = strpos($request->slide,';');
            $sub = substr($request->slide,0,$position);
            $ext = explode('/',$sub)[1];
            $image = time().'.'.$ext;
            $img = Image::make($request->slide);
            $upload_path = 'public/images/';
            $image_url = $upload_path.$image;
            $img->resize(800,500);
            $img->save($image_url);
        }
        else{
            $image_url='image/no_image.png';
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        //
    }
}
