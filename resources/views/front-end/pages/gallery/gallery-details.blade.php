@extends('front-end.layouts.master')
@section('content')
    <div class="container-fluid mt-5 pt-3">
        <div class="container">

            <div class="section-title mb-0">
                <h4 class="m-0 text-uppercase font-weight-bold">Gallery Details</h4>
            </div>
            <div class="bg-white border border-top-0 p-4 mb-3">
                <h5 class="mb-2"> {{ @ $gallery->title}}</h5>
                <p class="mb-2">{!! @ $gallery->description !!}</p>
                <img class="w-100 mb-2" src="{{@ asset($gallery->image)}}" alt="">
                <div class="row mb-2">
                    @foreach($gallery_images as $img)
                    <div class="col-md-4" style="margin: 11px 0 11px 0">
                        <a target="_blank" href="{{asset($img->image)}}">
                            <img class="img-fluid rounded img-thumbnail"
                                 src="{{asset($img->image)}}" alt="User profile picture">
                        </a>
                    </div>
                @endforeach
                </div> 
            </div>
        </div>
    </div>

@endsection
