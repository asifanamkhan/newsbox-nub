@extends('back-end.layouts.master')
@section('content-header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">

    <h1 style="font-family: 'Arial Narrow';">
        News
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i> Dashboard</a></li>
        <li class="active">news</li>
    </ol>
@endsection
@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <a target="_blank" href="{{asset($news->image)}}">
                                <img class="img-fluid rounded img-thumbnail"
                                     src="{{asset($news->image)}}" alt="User profile picture">
                            </a>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped" style="margin-top: 12px">
                                <tr>
                                    <th style="width: 20%">Title</th>
                                    <td style="width: 80%">
                                        <b style="color: orangered">{{$news->title}}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="">Date</th>
                                    <td style="">{{$news->date}}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($news->status == 1)
                                            <span class="badge badge-success" style="background: darkgreen">Active</span>
                                        @else
                                            <span class="badge badge-danger" style="background: darkred">In Active</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th style="">Type</th>
                                    <td style="">{{$news->type_name}}</td>
                                </tr>
                                <tr>
                                    <th style="">Category</th>
                                    <td style="">{{$news->category_name}}</td>
                                </tr>
                                <tr>
                                    <th style="">View count</th>
                                    <td style="">{{$news->views_count ?? 0}}</td>
                                </tr>
                                <tr>
                                    <th style="">Created By</th>
                                    <td style="">{{$news->created_user_name}}</td>
                                </tr>

                            </table>
                        </div>
                    </div>

                </div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th style="font-size: 20px">Description</th>
                        </tr>
                        <tr>
                            <td>{!! $news->description !!}</td>
                        </tr>
                    </table>
                </div>
                <!-- /.col -->
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#side-events").addClass('active');
            $("#side-events").addClass('active-sidebar');
        });

    </script>
@endsection
