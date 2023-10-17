@php
    $abouts = \Illuminate\Support\Facades\DB::table('abouts')->first();
@endphp
@extends('front-end.layouts.master')
@section('content')
    <div class="container-fluid mt-5 pt-3">
        <div class="container">

            <div class="section-title mb-0">
                <h4 class="m-0 text-uppercase font-weight-bold">About Us</h4>
            </div>
            <div class="bg-white border border-top-0 p-4 mb-3">
                <h4>
                    {!! @$abouts->about !!}
                </h4>
            </div>
        </div>
    </div>

@endsection
