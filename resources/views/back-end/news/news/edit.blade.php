@extends('back-end.layouts.master')
@section('content-header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <h1 style="font-family: 'Arial Narrow';">
        News Edit
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i> News</a></li>
        <li class="active">news edit</li>
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
                <form action="{{route('news.update', $news->id)}}" method="post">
                    @csrf
                    @method('PUT')
                   
                    <div class="form-group col-md-12">
                        <label for="">Title</label><span style="font-weight: bold; color: red"> *</span>
                        <input type="text" name="title" class="form-control" value="{{$news->title}}">
                    </div>

                    <div class="col-md-7">
                        <div class="mt-4">
                            <label for="">Type</label><span style="font-weight: bold; color: red"> *</span>
                            <select name="type" id="type" class="form-control select2">
                                <option value="">Select</option>
                                @foreach($news_types as $news_type)
                                    <option @if($news->type == $news_type->id) selected @endif value="{{$news_type->id}}" >{{$news_type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="">Category</label><span style="font-weight: bold; color: red"> *</span>
                            <select name="category_id" id="category_id" class="form-control select2">
                                <option value="">Select</option>
                                @foreach($categories as $category)
                                    <option @if($news->category_id == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="">Description</label><span style="font-weight: bold; color: red"> *</span>
                            <textarea name="description" id="" class="form-control tinymce-editor" cols="30" rows="10">{{$news->description}}</textarea>
                            <div class="col-md-12">
                                <label for="" style="color: blue">Short Description for display home (N: B: Within 15 word is recommended)</label><span style="font-weight: bold; color: red"> *</span>
                                <textarea name="short_description" id="" class="form-control" cols="30" rows="5">{{$news->short_description}}</textarea>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Date</label><span style="font-weight: bold; color: red"> *</span>
                                <input type="text" name="date" class="form-control  datepicker" value="{{$news->date}}">
                            </div>

                            <div class="col-md-12">
                                <div>
                                    <label for="">Old Image</label>
                                    <img  src="{{asset($news->image)}}" alt="" class="img-fluid rounded img-thumbnail">
                                    <input type="hidden" name="old_image" id="" value="{{$news->image}}">
                                </div>

                                <label for="">New Image</label>
                                <input type="hidden" name="image" id="image">
                                <div id="dropzoneForm" class="dropzone">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group col-md-12" style="margin-top: 8px">
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
        $(document).ready(function () {
            $("#side-news").addClass('active');
            $("#side-news-news").addClass('active');
            $("#side-news-news").addClass('active-sidebar');
        });
        tinymce.init({
            selector: '.tinymce-editor',
            height: 300,
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
