@extends('back-end.layouts.master')
@section('content-header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">

    <h1 style="font-family: 'Arial Narrow';">
        Ads Create
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i> Dashboard</a></li>
        <li class="active">ads</li>
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
            <div class="row">
                <div class="col-md-7 ima">
                    <form id="create_form" action="{{route('ads.update',$ads->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-md-12">
                            <label for="">Title</label><span style="font-weight: bold; color: red"> *</span>
                            <input type="text" name="title" value="{{$ads->title}}" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Description</label><span style="font-weight: bold; color: red"> *</span>
                            <textarea name="description" id="" cols="30" class="form-control" rows="2">{{$ads->title}}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Link</label><span style="font-weight: bold; color: red"> *</span>
                            <input type="text" name="link" value="{{$ads->link}}" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label for="">Old Image</label>
                                <img  src="{{asset($ads->image)}}" alt="" class="img-fluid rounded img-thumbnail" style="width: 100%; height: 300px">
                                <input type="hidden" name="old_image" id="" value="{{$ads->image}}">
                            </div>

                            <label for="">New Image</label>
                            <input type="hidden" name="image" id="image">
                            <div id="dropzoneForm" class="dropzone">
                            </div>
                        </div>
                        <div class="form-group col-md-12" style="margin-top: 20px">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
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
    </script>



    <script>
        $(document).ready(function () {
            $("#side-ades").addClass('active');
            $("#side-ades").addClass('active-sidebar');
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
