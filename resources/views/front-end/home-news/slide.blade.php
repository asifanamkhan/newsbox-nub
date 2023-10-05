@php
    $banner_slides = \Illuminate\Support\Facades\DB::table('sliders')
            ->where('status',1)
            ->where('type',1)
            ->get();

    $featured_slides = \Illuminate\Support\Facades\DB::table('sliders')
            ->where('sliders.type',2)
            ->where('sliders.status',1)
            ->leftjoin('news', 'sliders.news_id', '=', 'news.id')
            ->leftjoin('news_categories', 'news.category_id', '=', 'news_categories.id')
            ->orderBy('sliders.id', 'DESC')
            ->get(['sliders.*', 'news.title', 'news.date','news.image', 'news_categories.name as news_cat_name']);
    

@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-7 px-0">
            <div class="owl-carousel main-carousel position-relative">
                @foreach($banner_slides as $slide)
                    <div class="position-relative overflow-hidden" style="height: 500px;">
                        <img class="img-fluid h-100" src="{{asset($slide->image)}}" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                   href="">Business</a>
                                <a class="text-white" href="">Jan 01, 2045</a>
                            </div>
                            <a class="h2 m-0 text-white text-uppercase font-weight-bold" href="">Lorem ipsum dolor sit
                                amet elit. Proin vitae porta diam...</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-lg-5 px-0">
            <div class="row mx-0">
                @foreach($featured_slides as $slide)
                    <div class="col-md-6 px-0">
                        <div class="position-relative overflow-hidden" style="height: 250px;">
                            <img class="img-fluid w-100 h-100" src="{{asset($slide->image)}}"
                                 style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                       href="">Business</a>
                                    <a class="text-white" href=""><small>Jan 01, 2045</small></a>
                                </div>
                                <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="">Lorem ipsum dolor
                                    sit amet elit...</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>