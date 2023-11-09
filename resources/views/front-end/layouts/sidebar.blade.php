<!-- Social Follow Start -->
{{--<div class="mb-3 @if(\Request::route()->getName() != 'home') mt-5 pt-3 @endif">--}}
{{--    <div class="section-title mb-0">--}}
{{--        <h4 class="m-0 text-uppercase font-weight-bold">Follow Us</h4>--}}
{{--    </div>--}}
{{--    <div class="bg-white border border-top-0 p-3">--}}
{{--        @php--}}
{{--            $social_links = \Illuminate\Support\Facades\DB::table('social_links')--}}
{{--            ->get()--}}
{{--        @endphp--}}

{{--        @foreach($social_links as $social_link)--}}
{{--            <a href="" class="d-block w-100 text-white text-decoration-none mb-3"--}}
{{--               style="background: {{$social_link->color}};">--}}
{{--                <i class="fab {{$social_link->icon}}@if($social_link->name == 'Facebook')-f @endif--}}
{{--                 text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>--}}
{{--                <span class="font-weight-medium">12,345 Fans</span>--}}
{{--            </a>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Social Follow End -->

<!-- Ads Start -->
{{--<div class="mb-3 ">--}}
{{--    <div class="section-title mb-0">--}}
{{--        <h4 class="m-0 text-uppercase font-weight-bold">Advertisement</h4>--}}
{{--    </div>--}}
{{--    <div class="bg-white text-center border border-top-0 p-3">--}}
{{--        <a href=""><img class="img-fluid" src="{{asset('public/front-end/img/news-800x500-2.jpg')}}" alt=""></a>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Ads End -->

<!-- Popular News Start -->
@php
    $trending_news = \Illuminate\Support\Facades\DB::table('news')
                ->where('news.type',1)
                ->leftjoin('news_categories', 'news.category_id', '=', 'news_categories.id')
                ->orderBy('news.id', 'DESC')
                ->select(['news.*','news_categories.name as news_cat_name'])
                ->take(5)->get();
@endphp

@if(\Request::route()->getName() == 'home')
    <div class="mb-3">
        <div class="section-title mb-0">
            <h4 class="m-0 text-uppercase font-weight-bold">Trending News</h4>
        </div>
        <div class="bg-white border border-top-0 p-3">
            @foreach($trending_news as $trending_new)
                <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                    <img class="img-fluid" style="height: 110px; width: 110px" src="{{asset($trending_new->image)}}"
                         alt="">
                    <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2"
                               href="">{{$trending_new->news_cat_name}}</a>
                            <a class="text-body"
                               href=""><small>{{\Carbon\Carbon::parse($trending_new->date)->format('M d, Y')}}</small></a>
                        </div>
                        @php
                            $latest_title = substr($trending_new->title,0, 25);
                        @endphp
                        <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="">{{$latest_title}}
                            ...</a>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
@endif

<!-- Popular News End -->

<!-- Newsletter Start -->
<div class="mb-3 @if(\Request::route()->getName() != 'home') mt-5 pt-3 @endif" >
    <div class="section-title mb-0">
        <h4 class="m-0 text-uppercase font-weight-bold">Newsletter</h4>
    </div>
    <div class="bg-white text-center border border-top-0 p-3">
        <p>Subscribe tog get latest news in email</p>
        <form action="{{route('newsletter.store')}}" method="post">
            @csrf
            <div class="input-group mb-2" style="width: 100%;">
                <input type="text" name="email" class="form-control form-control-lg" placeholder="Your Email">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary font-weight-bold px-3">Sign Up</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Newsletter End -->

<!-- Tags Start -->
@if(\Request::route()->getName() == 'home')
    <div class="mb-3">
        <div class="section-title mb-0">
            <h4 class="m-0 text-uppercase font-weight-bold">Tags</h4>
        </div>
        <div class="bg-white border border-top-0 p-3">
            <div class="d-flex flex-wrap m-n1">
                @foreach($news_categories as $news_category)
                    <a href="" class="btn btn-sm btn-outline-secondary m-1">{{$news_category->name}}</a>
                @endforeach

            </div>
        </div>
    </div>
@endif
<!-- Tags End -->
