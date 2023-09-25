@extends('back-end.layouts.master')
@section('content-header')
    <h1 style="font-family: 'Arial Narrow';">
        General Settings
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i> Settings</a></li>
        <li class="active">general</li>
    </ol>
@endsection
@section('content')

    <div class="box">
        <div class="box-body">
            <form id="create_form" action="{{route('general-settings.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">Site Name</label><span style="font-weight: bold; color: red"> *</span>
                        <input @if($general_settings) value="{{$general_settings->site_name}}" @endif  name="site_name" type="text" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Phone</label><span style="font-weight: bold; color: red"> *</span>
                        <input @if($general_settings) value="{{$general_settings->phone}}" @endif name="phone" type="text" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Email</label><span style="font-weight: bold; color: red"> *</span>
                        <input  @if($general_settings) value="{{$general_settings->email}}" @endif name="email" type="email" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Address</label><span style="font-weight: bold; color: red"> *</span>
                        <textarea class="form-control" name="address" id="" cols="30" rows="5"> @if($general_settings) {{$general_settings->address}} @endif</textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <button onclick="confirm(`Are You Sure ?`)" style="float: right"
                                class="btn btn-sm btn-grad">SAVE
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>



@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#side-settings").addClass('active');
            $("#side-general").addClass('active');
        });
    </script>
    <script>
        $().ready(function () {
            $("#create_form").validate({
                rules: {
                    site_name: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                },
            });

        })
    </script>
@endsection