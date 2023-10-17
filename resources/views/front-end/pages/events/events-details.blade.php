@extends('front-end.layouts.master')
@section('content')
    <div class="container-fluid mt-5 pt-3">
        <div class="container">

            <div class="section-title mb-0">
                <h4 class="m-0 text-uppercase font-weight-bold">Events Details</h4>
            </div>
            <div class="bg-white border border-top-0 p-4 mb-3">
                <h5 class="mb-2"> {{ @ $events->title}}</h5>
                <p class="mb-2">{!! @ $events->description !!}</p>
                <img class="w-100 mb-2" src="{{@ asset($events->image)}}" alt="">
            </div>
        </div>
    </div>

@endsection
