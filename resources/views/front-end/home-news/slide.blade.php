@php
    $slides = \Illuminate\Support\Facades\DB::table('sliders')
            ->where('sliders.status',1)
            ->leftjoin('news', 'sliders.news_id', '=', 'news.id')
            ->leftjoin('news_categories', 'news.category_id', '=', 'news_categories.id')
            ->orderBy('sliders.id', 'DESC')
            ->get(['sliders.*',
                'news.title as news_title',
                'news.date as news_date','news.image as news_image',
                'news_categories.name as news_cat_name'
                ]);



@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-7 px-0">
            <div class="owl-carousel main-carousel position-relative">
                @foreach($slides as $slide)
                    @if($slide->type == 1)
                        <div class="position-relative overflow-hidden" style="height: 500px;">
                            <img class="img-fluid h-100" src="{{asset($slide->image)}}" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                       href=""></a>
                                    <a class="text-white" href="">{{\Carbon\Carbon::parse($slide->news_date)->format('M d, Y')}}</a>
                                </div>
                                <a class="h2 m-0 text-white text-uppercase font-weight-bold"
                                   href="">{{$slide->title}}</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="col-lg-5 px-0">
            <div class="row mx-0">
                @foreach($slides as $slide)
                    @if($slide->type == 2)
                        <div class="col-md-6 px-0">
                            <div class="position-relative overflow-hidden" style="height: 250px;">
                                <img class="img-fluid w-100 h-100" src="{{asset($slide->news_image)}}"
                                     style="object-fit: cover;">
                                <div class="overlay">
                                    <div class="mb-2">
                                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                           href="">{{$slide->news_cat_name}}</a>
                                        <a class="text-white"
                                           href="#"><small>{{\Carbon\Carbon::parse($slide->news_date)->format('M d, Y')}}</small></a>
                                    </div>
                                    <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="">Lorem
                                        {{$slide->news_title}}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>