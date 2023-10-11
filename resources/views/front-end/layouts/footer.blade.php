@php
    $Popular_news = \Illuminate\Support\Facades\DB::table('news')
                ->where('news.type',5)
                ->leftjoin('news_categories', 'news.category_id', '=', 'news_categories.id')
                ->orderBy('news.id', 'DESC')
                ->select(['news.*','news_categories.name as news_cat_name'])
                ->take(3)->get();
@endphp
<div class="container-fluid bg-dark pt-5 px-sm-3 px-md-5 mt-5">
    <div class="row py-4">
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="mb-4 text-white text-uppercase font-weight-bold">Get In Touch</h5>
            <p class="font-weight-medium"><i class="fa fa-map-marker-alt mr-2"></i> @if($general_settings) {{$general_settings->address}} @endif</p>
            <p class="font-weight-medium"><i class="fa fa-phone-alt mr-2"></i>@if($general_settings) {{$general_settings->phone}} @endif</p>
            <p class="font-weight-medium"><i class="fa fa-envelope mr-2"></i>@if($general_settings) {{$general_settings->email}} @endif</p>
            <h6 class="mt-4 mb-3 text-white text-uppercase font-weight-bold">Follow Us</h6>
            <div class="d-flex justify-content-start">
                <a class="btn btn-lg btn-secondary btn-lg-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-lg btn-secondary btn-lg-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-lg btn-secondary btn-lg-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-lg btn-secondary btn-lg-square mr-2" href="#"><i class="fab fa-instagram"></i></a>
                <a class="btn btn-lg btn-secondary btn-lg-square" href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="mb-4 text-white text-uppercase font-weight-bold">Popular News</h5>



            @foreach($Popular_news as $item)
                <div class="mb-3">
                    <div class="mb-2">
                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="">{{$item->news_cat_name}}</a>
                        <a class="text-body" href=""><small>{{\Carbon\Carbon::parse($item->date)->format('M d, Y')}}</small></a>
                    </div>
                    @php
                        $title = substr($item->title,0, 60);
                    @endphp
                    <a class="small text-body text-uppercase font-weight-medium" href="">{{$title}} ...</a>
                </div>
            @endforeach


        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="mb-4 text-white text-uppercase font-weight-bold">Categories</h5>
            <div class="m-n1">
                @foreach($news_categories as $item)
                    <a href="" class="btn btn-sm btn-secondary m-1">{{$item->name}}</a>
                @endforeach
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="mb-4 text-white text-uppercase font-weight-bold">Flickr Photos</h5>
            <div class="row">
                <div class="col-4 mb-3">
                    <a href=""><img class="w-100" src="{{asset('public/front-end/img/news-110x110-1.jpg')}}" alt=""></a>
                </div>
                <div class="col-4 mb-3">
                    <a href=""><img class="w-100" src="{{asset('public/front-end/img/news-110x110-2.jpg')}}" alt=""></a>
                </div>
                <div class="col-4 mb-3">
                    <a href=""><img class="w-100" src="{{asset('public/front-end/img/news-110x110-3.jpg')}}" alt=""></a>
                </div>
                <div class="col-4 mb-3">
                    <a href=""><img class="w-100" src="{{asset('public/front-end/img/news-110x110-4.jpg')}}" alt=""></a>
                </div>
                <div class="col-4 mb-3">
                    <a href=""><img class="w-100" src="{{asset('public/front-end/img/news-110x110-5.jpg')}}" alt=""></a>
                </div>
                <div class="col-4 mb-3">
                    <a href=""><img class="w-100" src="{{asset('public/front-end/img/news-110x110-1.jpg')}}" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</div>
