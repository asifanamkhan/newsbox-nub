@php
    $notice = \Illuminate\Support\Facades\DB::table('notices')->get();
@endphp
@extends('front-end.layouts.master')
@section('content')
    <div class="container-fluid mt-5 pt-3">
        <div class="container">

            <div class="section-title mb-0">
                <h4 class="m-0 text-uppercase font-weight-bold">Notice</h4>
            </div>
            <div class="bg-white border border-top-0 p-4 mb-3">
                <div class="row">
                    @foreach($notice as $notice)
                    <div class="col-lg-6">
                       <a href="{{route('notice-details',$notice->id)}}"><img class="w-100 mb-2" src="{{ asset($notice->image)}}" alt=""></a> 
                      <a href="{{route('notice-details',$notice->id)}}"><h5> {{ $notice->title}}</h5></a>  
                    </div>
                @endforeach
                </div> 
            </div>
        </div>
    </div>

@endsection
