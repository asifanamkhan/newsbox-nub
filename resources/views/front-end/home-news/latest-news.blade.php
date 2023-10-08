@php
    $latest_news = \Illuminate\Support\Facades\DB::table('news')
                ->where('news.type',2)
                ->leftjoin('news_categories', 'news.category_id', '=', 'news_categories.id')
                ->orderBy('news.id', 'DESC')
                ->select(['news.*','news_categories.name as news_cat_name'])
                ->take(12)->get();

//    dd($latest_news);
@endphp

<div class="row">
    <div class="col-12">
        <div class="section-title">
            <h4 class="m-0 text-uppercase font-weight-bold">Latest News</h4>
            <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
        </div>
    </div>
    @foreach($latest_news as $latest)
        <div class="col-lg-6">
            <div class="position-relative mb-3">
                <img class="img-fluid w-100" src="{{asset($latest->image)}}" style="object-fit: cover;">
                <div class="bg-white border border-top-0 p-4">
                    <div class="mb-2">
                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                           href="">{{$latest->news_cat_name}}</a>
                        <a class="text-body" href=""><small>{{\Carbon\Carbon::parse($latest->date)->format('M d, Y')}}</small></a>
                    </div>
                    <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="">
                        @php
                        $latest_title = substr($latest->title,0, 25);
                        $latest_desc = substr($latest->short_description,0, 70);
                        @endphp
                        {{$latest_title}}...</a>
                    <p class="m-0">{{$latest_desc}} ...</p>
                </div>
                <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle mr-2" src="{{asset('public/front-end/img/user.jpg')}}" width="25" height="25" alt="">
                        <small>John Doe</small>
                    </div>
                    <div class="d-flex align-items-center">
                        <small class="ml-3"><i class="far fa-eye mr-2"></i>12345</small>
                        <small class="ml-3"><i class="far fa-comment mr-2"></i>123</small>
                    </div>
                </div>
            </div>
        </div>
        @if($loop->iteration > 3) @break @endif
    @endforeach

    <div class="col-lg-6">
        @foreach($latest_news as $latest)
           @if($loop->iteration > 3 && $loop->iteration <= 5)
                <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                    <img class="img-fluid" style="height: 110px; width: 110px" src="{{asset($latest->image)}}" alt="">
                    <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="">{{$latest->news_cat_name}}</a>
                            <a class="text-body" href=""><small>{{\Carbon\Carbon::parse($latest->date)->format('M d, Y')}}</small></a>
                        </div>
                        @php
                            $latest_title = substr($latest->title,0, 25);
                        @endphp
                        <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="">{{$latest_title}} ...</a>
                    </div>
                </div>
           @endif
        @endforeach
    </div>
    <div class="col-lg-6">
        @foreach($latest_news as $latest)
            @if($loop->iteration > 5 && $loop->iteration <= 7)
                <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                    <img class="img-fluid" style="height: 110px; width: 110px" src="{{asset($latest->image)}}" alt="">
                    <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="">{{$latest->news_cat_name}}</a>
                            <a class="text-body" href=""><small>{{\Carbon\Carbon::parse($latest->date)->format('M d, Y')}}</small></a>
                        </div>
                        @php
                            $latest_title = substr($latest->title,0, 25);
                        @endphp
                        <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="">{{$latest_title}} ...</a>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="col-lg-12 mb-3">
        <a href=""><img class="img-fluid w-100" src="{{asset('public/front-end/img/ads-728x90.png')}}" alt="">Add</a>
    </div>
    @if(isset($latest_news[8]))
        <div class="col-lg-12">
            <div class="row news-lg mx-0 mb-3">
                <div class="col-md-6 h-100 px-0">
                    <img class="img-fluid h-100" src="{{$latest_news[8]->image}}" style="object-fit: cover;">
                </div>
                <div class="col-md-6 d-flex flex-column border bg-white h-100 px-0">
                    <div class="mt-auto p-4">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                               href="">{{$latest_news[8]->news_cat_name}}</a>
                            <a class="text-body" href=""><small>{{\Carbon\Carbon::parse($latest_news[8]->date)->format('M d, Y')}}</small></a>
                        </div>
                        @php
                            $latest_title = substr($latest_news[8]->title,0, 25);
                            $latest_desc = substr($latest_news[8]->short_description,0, 100);
                        @endphp
                        <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="">{{$latest_title}}</a>
                        <p class="m-0">{{$latest_desc}}</p>
                    </div>
                    <div class="d-flex justify-content-between bg-white border-top mt-auto p-4">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle mr-2" src="{{asset('public/front-end/img/user.jpg')}}" width="25" height="25" alt="">
                            <small>John Doe</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <small class="ml-3"><i class="far fa-eye mr-2"></i>12345</small>
                            <small class="ml-3"><i class="far fa-comment mr-2"></i>123</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="col-lg-6">
        <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
            <img class="img-fluid" src="{{asset('public/front-end/img/news-110x110-1.jpg')}}" alt="">
            <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                <div class="mb-2">
                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="">Business</a>
                    <a class="text-body" href=""><small>Jan 01, 2045</small></a>
                </div>
                <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="">Lorem ipsum dolor sit amet elit...</a>
            </div>
        </div>
        <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
            <img class="img-fluid" src="{{asset('public/front-end/img/news-110x110-2.jpg')}}" alt="">
            <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                <div class="mb-2">
                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="">Business</a>
                    <a class="text-body" href=""><small>Jan 01, 2045</small></a>
                </div>
                <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="">Lorem ipsum dolor sit amet elit...</a>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
            <img class="img-fluid" src="{{asset('public/front-end/img/news-110x110-3.jpg')}}" alt="">
            <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                <div class="mb-2">
                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="">Business</a>
                    <a class="text-body" href=""><small>Jan 01, 2045</small></a>
                </div>
                <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="">Lorem ipsum dolor sit amet elit...</a>
            </div>
        </div>
        <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
            <img class="img-fluid" src="{{asset('public/front-end/img/news-110x110-4.jpg')}}" alt="">
            <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                <div class="mb-2">
                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="">Business</a>
                    <a class="text-body" href=""><small>Jan 01, 2045</small></a>
                </div>
                <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="">Lorem ipsum dolor sit amet elit...</a>
            </div>
        </div>
    </div>
</div>