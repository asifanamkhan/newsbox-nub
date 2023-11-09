@php
    $featured_news = \Illuminate\Support\Facades\DB::table('news')
                ->where('news.type',3)
                ->leftjoin('news_categories', 'news.category_id', '=', 'news_categories.id')
                ->orderBy('news.id', 'DESC')
                ->select(['news.*','news_categories.name as news_cat_name'])
                ->take(10)->get();
@endphp
<div class="container-fluid pt-5 mb-3">
    <div class="container">
        <div class="section-title">
            <h4 class="m-0 text-uppercase font-weight-bold">Upcoming News</h4>
        </div>
        <div class="owl-carousel news-carousel carousel-item-4 position-relative">
            @foreach($featured_news as $featured)
                <div class="position-relative overflow-hidden" style="height: 300px;">
                    <img class="img-fluid h-100" src="{{asset($featured->image)}}" style="object-fit: cover;">
                    <div class="overlay">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                               href="">{{$featured->news_cat_name}}</a>
                            <a class="text-white" href=""><small>{{\Carbon\Carbon::parse($featured->date)->format('M d, Y')}}</small></a>
                        </div>
                        @php
                            $featured_title = substr($featured->title,0, 25);
                        @endphp
                        <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="{{route('single-news-details',$featured->id)}}">
                            {{$featured_title}}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>