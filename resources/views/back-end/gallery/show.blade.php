@extends('back-end.layouts.master')
@section('content-header')
    <h1 style="font-family: 'Arial Narrow';">
        Gallery
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i> Dashboard</a></li>
        <li class="active">gallery</li>
    </ol>
@endsection
@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <a target="_blank" href="{{asset($gallery->image)}}">
                                <img class="img-fluid rounded img-thumbnail"
                                     src="{{asset($gallery->image)}}" alt="User profile picture">
                            </a>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped" style="margin-top: 12px">
                                <tr>
                                    <th style="width: 20%">Title</th>
                                    <td style="width: 80%">
                                        <b style="color: orangered">{{$gallery->title}}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($gallery->status == 1)
                                            <span class="badge badge-success" style="background: darkgreen">Active</span>
                                        @else
                                            <span class="badge badge-danger" style="background: darkred">In Active</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 20%">Description</th>
                                    <td>{!! $gallery->description !!}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="col-md-8">
                  <div class="row">
                      @foreach($gallery_images as $img)
                          <div class="col-md-4" style="margin: 11px 0 11px 0">
                              <a target="_blank" href="{{asset($img->image)}}">
                                  <img class="img-fluid rounded img-thumbnail"
                                       src="{{asset($img->image)}}" alt="User profile picture">
                              </a>
                          </div>
                      @endforeach
                  </div>
                </div>
                <!-- /.col -->
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#side-gallery").addClass('active');
            $("#side-gallery").addClass('active-sidebar');
        });

    </script>
@endsection
