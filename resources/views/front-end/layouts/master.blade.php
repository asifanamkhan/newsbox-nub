<!DOCTYPE html>
<html lang="en">

@include('front-end.layouts.header')

<body>
<!-- Topbar Start -->
@include('front-end.layouts.topbar')
@include('front-end.layouts.css')
<!-- Topbar End -->


<!-- Navbar Start -->
@php
    $news_categories = \Illuminate\Support\Facades\DB::table('news_categories')->get();
@endphp
@include('front-end.layouts.nav')
<!-- Navbar End -->
@if(\Request::route()->getName() == 'home')
    <!-- Main News Slider Start -->
    @include('front-end.home-news.slide')
    <!-- Main News Slider End -->

    <!-- Breaking News Start -->
    @include('front-end.home-news.breaking-news')
    <!-- Breaking News End -->

    <!-- Featured News Slider Start -->

    @include('front-end.home-news.featured')
@endif
<!-- Featured News Slider End -->

<!-- News With Sidebar Start -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @yield('content')
            </div>
            <div class="col-lg-4">
                @include('front-end.layouts.sidebar')
            </div>
        </div>
    </div>
</div>
<!-- News With Sidebar End -->


<!-- Footer Start -->
@include('front-end.layouts.footer')
<!-- Footer End -->

@include('front-end.layouts.js')
<!-- Back to Top -->
<a href="#" class="btn btn-primary btn-square back-to-top"><i class="fa fa-arrow-up"></i></a>

</body>

</html>