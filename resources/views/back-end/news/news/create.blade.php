@extends('back-end.layouts.master')
@section('content-header')
    <h1 style="font-family: 'Arial Narrow';">
        News Create
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i> News</a></li>
        <li class="active">news</li>
    </ol>
@endsection
@section('content')
    <div class="box">
        <div class="box-body">
            @if ($errors->any())
                <div style="width: 20%">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{--            <section class="loading">--}}
            {{--                <div class="loading-content">--}}
            {{--                    <i class="fa fa-spinner fa-spin"></i>--}}
            {{--                </div>--}}
            {{--            </section>--}}
            <div class="row">
                <form action="{{route('news.store')}}" method="post">
                    @csrf
                    <div class="form-group col-md-12">
                        <label for="">Title</label><span style="font-weight: bold; color: red"> *</span>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Type</label><span style="font-weight: bold; color: red"> *</span>
                        <select name="" id="">
                            <option value="featured">Featured</option>
                            <option value="latest">Latest</option>
                            <option value="latest">Trending</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <button class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#side-news").addClass('active');
            $("#side-News").addClass('active');
            $("#side-News").addClass('active-sidebar');
        });
    </script>
@endsection
