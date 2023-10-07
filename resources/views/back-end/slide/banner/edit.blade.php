@extends('back-end.layouts.master')
@section('content-header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">

    <h1 style="font-family: 'Arial Narrow';">
        Slides Edit
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i> Settings</a></li>
        <li class="active">slide</li>
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
                <div class="col-md-12 ima">
                    <form id="create_form" action="{{route('slides.update',$sliders->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="news_id" id="news_id" value="{{$sliders->news_id}}">
                        <div class="form-group col-md-12">
                            <label for="">Title</label><span style="font-weight: bold; color: red"> *</span>
                            <input type="text" name="title" class="form-control" value="{{$sliders->title}}">
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label for="">Old Image</label>
                                <img  src="{{asset($sliders->image)}}" alt="" class="img-fluid rounded img-thumbnail">
                                <input type="hidden" name="old_image" id="" value="{{$sliders->image}}">
                            </div>

                            <label for="">New Image</label>
                            <input type="hidden" name="image" id="image">
                            <div id="dropzoneForm" class="dropzone">
                            </div>
                        <div class="form-group col-md-12 " style="margin-top: 10px">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script>
        $(document).ready(function () {
            $("#side-slide").addClass('active');
            $("#side-banner-slide").addClass('active');
            $("#side-banner-slide").addClass('active-sidebar');

            $("#create_form").validate({
                rules: {
                    title: {
                        required: true,
                    },
                },
            });
        });
    </script>
    <script type="text/javascript">

        Dropzone.options.dropzoneForm = {
            url: "no-path",
            autoProcessQueue: false,
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
            addRemoveLinks: true,
            parallelUploads: 1,
            maxFilesize: 5,
            maxFiles: 1,
            init: function () {
                this.on("addedfile", (file) => {
                    if (this.files[1] != null) {
                        this.removeFile(this.files[0]);
                    } else {
                        var reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = event => {
                            $('#image').val(event.target.result)
                        }
                    }
                });

                this.on('removedfile', function (file) {
                    $('#image').val(' ');
                });

            },

        };

    </script>
@endsection
