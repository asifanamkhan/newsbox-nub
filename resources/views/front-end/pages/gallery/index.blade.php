@php
    $galleries = \Illuminate\Support\Facades\DB::table('galleries')->get();
@endphp
@extends('front-end.layouts.master')
@section('content')
    <div class="container-fluid mt-5 pt-3">
        <div class="container">

            <div class="section-title mb-0">
                <h4 class="m-0 text-uppercase font-weight-bold">Gallery</h4>
            </div>
            <div class="bg-white border border-top-0 p-4 mb-3">
                <div class="row">
                    @foreach($galleries as $galleries)
                    <div class="col-lg-6">
                       <a href="{{route('gallery-details',$galleries->id)}}"><img class="w-100 mb-2" src="{{ asset($galleries->image)}}" alt=""></a> 
                      <a href="{{route('gallery-details',$galleries->id)}}"><h5> {{ $galleries->title}}</h5></a>  
                    </div>
                @endforeach
                </div> 
            </div>
        </div>
    </div>

@endsection
