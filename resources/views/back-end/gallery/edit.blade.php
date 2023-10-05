@extends('back-end.layouts.master')
@section('content-header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">

    <h1 style="font-family: 'Arial Narrow';">
        Gallery Edit
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i> Dashboard</a></li>
        <li class="active">gallery edit</li>
    </ol>
@endsection
@section('content')
    <style>
        .tox-notifications-container{
            display: none; !important;
        }
        .tox .tox-statusbar__text-container {
            display: none;
        }
    </style>
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
                <div class="col-md-7">
                    <form id="create_form" action="{{route('gallery.update', $gallery->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div id="img-body">
                            <input type="hidden" name="image" id="image">
                            <input type="hidden" name="old_image" id="" value="{{$gallery->image}}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Title</label><span style="font-weight: bold; color: red"> *</span>
                            <input type="text" value="{{$gallery->title}}" name="title" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Description</label><span style="font-weight: bold; color: red"> *</span>
                            <textarea name="description" id="" cols="30" class="form-control tinymce-editor" rows="10">{!! $gallery->description !!}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-5">
                    <div>
                        <label for="">Image</label>
                        <img  src="{{asset($gallery->image)}}" alt="" class="img-fluid rounded img-thumbnail">
                    </div>
                    <div class="mt-5">
                        <label for="">New Image</label>
                        <form id="dropzoneForm" class="dropzone" action="{{ route('gallery.store') }}">
                            @csrf
                        </form>

                    </div>
                </div>


            </div>

        </div>
    </div>

@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $().ready(function () {
            $("#create_form").validate({
                rules: {
                    title: {
                        required: true,
                    },
                    description: {
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
            $("#side-events").addClass('active');
            $("#side-events").addClass('active-sidebar');
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
