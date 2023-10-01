@extends('back-end.layouts.master')
@section('content-header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">

    <h1 style="font-family: 'Arial Narrow';">
        Events
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i> Dashboard</a></li>
        <li class="active">events</li>
    </ol>
@endsection
@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <img class="img-fluid rounded img-thumbnail"
                         src="{{asset($event->image)}}" alt="User profile picture">


                </div>
                <div class="col-md-9">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 15%">Title</th>
                            <td style="width: 85%">{{$event->title}}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($event->status == 1)
                                    <span class="badge badge-success" style="background: darkgreen">Active</span>
                                @else
                                    <span class="badge badge-danger" style="background: darkred">In Active</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{!! $event->description !!}</td>
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
