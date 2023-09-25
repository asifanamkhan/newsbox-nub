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
    <style>
        .tox-notifications-container{
            display: none; !important;
        }
    </style>
    <div class="box">
        <div class="box-body">
            <form id="create_form" action="{{route('about-us.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">About Us Description</label><span style="font-weight: bold; color: red"> *</span>
                        <textarea name="about" id="" class="form-control tinymce-editor" cols="30" rows="10">@if($abouts) {!! $abouts->about !!} @endif</textarea>
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
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $().ready(function () {
            $("#create_form").validate({
                rules: {
                    about: {
                        required: true,
                    },
                },
            });

        })


        tinymce.init({
            selector: '.tinymce-editor',
            height: 300,
        });
    </script>

    <script>

        $(document).ready(function () {
            $("#side-settings").addClass('active');
            $("#side-about-us").addClass('active');
            $("#side-about-us").addClass('active-sidebar');
        });
    </script>

@endsection