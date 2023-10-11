<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-2 py-lg-0 px-lg-5">
        <a href="{{route('home')}}" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 display-4 text-uppercase text-primary">NUB<span class="text-white font-weight-normal">NEWS</span></h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
            <div class="navbar-nav mr-auto py-0">
                <a href="{{route('home')}}" class="nav-item nav-link active">Home</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">News</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        @foreach($news_categories as $news_category)
                            <a href="#" class="dropdown-item">{{$news_category->name}}</a>
                        @endforeach
                    </div>
                </div>
                <a href="category.html" class="nav-item nav-link">About us</a>
                <a href="contact.html" class="nav-item nav-link">Gallery</a>
                <a href="contact.html" class="nav-item nav-link">Events</a>
                <a href="contact.html" class="nav-item nav-link">Achievements</a>
{{--                <a href="{{route('contactUs')}}" class="nav-item nav-link">Contact</a>--}}
            </div>
            <div class="input-group ml-auto d-none d-lg-flex" style="width: 100%; max-width: 300px;">
                <input type="text" class="form-control border-0" placeholder="Keyword">
                <div class="input-group-append">
                    <button class="input-group-text bg-primary text-dark border-0 px-3"><i
                                class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
    </nav>
</div>