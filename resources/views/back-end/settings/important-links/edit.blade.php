@extends('back-end.layouts.master')
@section('content-header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">

    <h1 style="font-family: 'Arial Narrow';">
        Edit Important Links
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i> Settings</a></li>
        <li class="active">edit important link</li>
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
            <div class="row">
                <div class="col-md-12">
                    <form id="create_form" action="{{route('important-links.update', $important_link->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-md-12">
                            <label for="">Title</label><span style="font-weight: bold; color: red"> *</span>
                            <input type="text" value="{{$important_link->title}}" name="title" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Link</label><span style="font-weight: bold; color: red"> *</span>
                            <input type="text" value="{{$important_link->link}}" name="link" class="form-control">
                        </div>

                        <div class="form-group col-md-12">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('js')

    <script>
        $(document).ready(function () {
            $("#side-settings").addClass('active');
            $("#side-important-link").addClass('active');
            $("#side-important-link").addClass('active-sidebar');

            $("#create_form").validate({
                rules: {
                    link: {
                        required: true,
                    },
                    title: {
                        required: true,
                    },
                },
            });
        });

    </script>
@endsection