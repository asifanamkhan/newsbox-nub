@extends('back-end.layouts.master')
@section('content-header')
    <h1 style="font-family: 'Arial Narrow';">
        Social Links
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i> Settings</a></li>
        <li class="active">social media links</li>
    </ol>
@endsection
@section('content')

    <div class="box">
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 4%">Icon</th>
                        <th style="width: 10%">Social Media</th>
                        <th style="width: 58%">Link</th>
                        <th style="width: 20%">Number of followers</th>
                        <th style="width: 8%">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($social_links as $value)
                    <form action="{{route('social-link.store')}}" method="post">
                        @csrf
                        <tr>
                            <td style="">
                                <div style="background:{{$value['color']}} ; color: white; font-size: 20px; padding: 1px; border-radius: 2px; text-align: center">
                                    <i class="{{$value['icon']}}"></i>
                                </div>
                            </td>
                            <td>
                                <input name="name" type="text" readonly  class="form-control" value="{{$value['name']}}">
                            </td>
                            <td>
                                <input required name="link" type="text" class="form-control" >
                            </td>
                            <td>
                                <input name="num_of_follower" type="number" class="form-control" value="">
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary">
                                    <i class="fa fa-check"></i> update
                                </button>
                            </td>
                        </tr>
                    </form>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#side-settings").addClass('active');
            $("#side-social-link").addClass('active');
        });
    </script>

@endsection