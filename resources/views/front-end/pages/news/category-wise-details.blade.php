@extends('front-end.layouts.master')
@section('content')
    <div class="container-fluid mt-5 pt-3">
        <div class="container">

            <div class="section-title mb-0">
                <h4 class="m-0 text-uppercase font-weight-bold">Latest news</h4>
            </div>
            <div class="bg-white border border-top-0 p-4 mb-3">
                <div class="row">
                    @foreach($news as $latest)
                        {{--                        <div class="col-lg-6">--}}
                        {{--                            <div class="position-relative mb-3">--}}
                        {{--                                <img class="img-fluid w-100" src="{{asset($latest->image)}}" style="object-fit: cover;">--}}
                        {{--                                <div class="bg-white border border-top-0 p-4">--}}
                        {{--                                    <div class="mb-2">--}}
                        {{--                                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"--}}
                        {{--                                           href="">{{$latest->news_cat_name}}</a>--}}
                        {{--                                        <a class="text-body" href=""><small>{{\Carbon\Carbon::parse($latest->date)->format('M d, Y')}}</small></a>--}}
                        {{--                                    </div>--}}
                        {{--                                    <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="">--}}
                        {{--                                        @php--}}
                        {{--                                            $latest_title = substr($latest->title,0, 25);--}}
                        {{--                                            $latest_desc = substr($latest->short_description,0, 70);--}}
                        {{--                                        @endphp--}}
                        {{--                                        {{$latest_title}}...</a>--}}
                        {{--                                    <p class="m-0">{{$latest_desc}} ...</p>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="d-flex justify-content-between bg-white border border-top-0 p-4">--}}
                        {{--                                    <div class="d-flex align-items-center">--}}
                        {{--                                        <img class="rounded-circle mr-2" src="{{asset('public/front-end/img/user.jpg')}}" width="25" height="25" alt="">--}}
                        {{--                                        <small>John Doe</small>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="d-flex align-items-center">--}}
                        {{--                                        <small class="ml-3"><i class="far fa-eye mr-2"></i>12345</small>--}}
                        {{--                                        <small class="ml-3"><i class="far fa-comment mr-2"></i>123</small>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="d-flex col-md-6 align-items-center bg-white mb-3" style="height: 110px;">
                            <img class="img-fluid" style="height: 110px; width: 110px" src="{{asset($latest->image)}}" alt="">
                            <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="">{{$latest->news_cat_name}}</a>
                                    <a class="text-body" href=""><small>{{\Carbon\Carbon::parse($latest->date)->format('M d, Y')}}</small></a>
                                </div>
                                @php
                                    $latest_title = substr($latest->title,0, 25);
                                     $latest_desc = substr($latest->short_description,0, 70);
                                @endphp
                                <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="{{route('single-news-details',$latest->id)}}">{{$latest_title}} ...</a>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
