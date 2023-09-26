@extends('back-end.layouts.master')
@section('content-header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">

    <h1 style="font-family: 'Arial Narrow';">
        Slides
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i> Settings</a></li>
        <li class="active">slide</li>
    </ol>
@endsection
@section('content')
    <div class="box">
        <div class="box-body">
            {{--            <section class="loading">--}}
            {{--                <div class="loading-content">--}}
            {{--                    <i class="fa fa-spinner fa-spin"></i>--}}
            {{--                </div>--}}
            {{--            </section>--}}
            <div class="row">
                <div class="form-group col-md-12">
                    <form id="dropzoneForm" class="dropzone" action="{{ route('slides.store') }}">
                        @csrf
                    </form>
                </div>
                <form action="{{route('slides.store')}}" method="post">
                    @csrf
                    <div id="img-body">
                        <input type="hidden" name="slide" id="image">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Title</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="form-group col-md-12">
                        <button class="btn btn-info">Upload</button>
                    </div>
                </form>

            </div>

        </div>
    </div>

@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script>
        $(document).ready(function () {
            $("#side-settings").addClass('active');
            $("#side-general").addClass('active');
            $("#side-general").addClass('active-sidebar');
        });
    </script>
    <script type="text/javascript">

        Dropzone.options.dropzoneForm = {
            autoProcessQueue: false,
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
            addRemoveLinks: true,
            parallelUploads: 1,
            maxFilesize: 5,
            maxFiles: 1,
            init: function () {

                this.on("addedfile", (file) => {
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    var imh = '';
                    reader.onload = event => {
                        $('#image').val(event.target.result)
                    }

                });

                this.on('removedfile', function (file) {
                    $('#image').val(' ');
                });

            },

        };

    </script>
@endsection