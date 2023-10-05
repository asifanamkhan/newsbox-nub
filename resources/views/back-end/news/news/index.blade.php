@extends('back-end.layouts.master')
@section('content-header')
    <h1 style="font-family: 'Arial Narrow';">
       News
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i>News</a></li>
        <li class="active">news</li>
    </ol>
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h5 class="box-title"><b>News List</b></h5>
            <a href="{{route('news.create')}}" id="add_new" style="float: right" class="btn btn-sm btn-grad">Create News</a>
        </div>
        <div class="box-body">
            <div class="row" style="margin-bottom: 5px">
                <div class="col-md-3">
                    <label for="">Date</label>
                    <input type="text" id="date" class="form-control datepicker" placeholder="">
                </div>
                <div class="col-md-3">
                    <label for="">Category</label>
                    <select name="" id="category_id" class="form-control select2">
                        <option value="">Select</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Type</label>
                    <select name="type" id="type" class="form-control select2">
                        <option value="">Select</option>
                        @foreach($news_types as $news_type)
                            <option value="{{$news_type->id}}">{{$news_type->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Title</label>
                    <input type="text" id="title" class="form-control" placeholder="">
                </div>
                <div class="col-md-12" style="margin-top: 5px">
                    <button id="search-btn" style="float: right" class="btn btn-sm btn-grad">Search</button>
                </div>
            </div>
            <table style="width: 100%" class="table table-responsive table-striped data-table" id="table">
                <thead class="table-header-background" style=";">
                <tr class="" style="text-align:center; ">
                    <th style="width: 8%">SL</th>
                    <th style="width: 14%">Image</th>
                    <th style="width: 10%">Date</th>
                    <th style="width: 26%">Title</th>
                    <th style="width: 9%">Category</th>
                    <th style="width: 9%">Type</th>
                    <th style="width: 12%">Status</th>
                    <th style="width: 12%">Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#side-news").addClass('active');
            $("#side-news-news").addClass('active');
            $("#side-news-news").addClass('active-sidebar');
        });

    </script>
    <script>
        var datatable = $('.data-table').DataTable({
            order: [],
            lengthMenu: [[10, 20, 30, 50, 100, -1], [10, 20, 30, 50, 100, "All"]],
            processing: true,
            responsive: true,
            serverSide: true,
            searching: false,
            language: {
                processing: '<i class="ace-icon fa fa-spinner fa-spin bigger-500" style="font-size:60px;"></i>'
            },
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",

            ajax: {
                url: "{{route('news.index')}}",
                type: "get",
                data: function (d) {
                    d.date = $('#date').val(),
                        d.category_id = $('#category_id').val(),
                        d.type = $('#type').val(),
                        d.title = $('#title').val()
                }
            },

            columns: [
                {data: "DT_RowIndex", name: "DT_RowIndex", orderable: false,},
                {data: 'image', name: 'image', orderable: false},
                {data: 'date', name: 'date', orderable: true},
                {data: 'title', name: 'title', orderable: true},
                {data: 'category_id', name: 'category_id', orderable: true},
                {data: 'type', name: 'type', orderable: true},
                {data: 'status', name: 'status', orderable: true},
                {data: 'action', searchable: false, orderable: false}

                //only those have manage_user permission will get access

            ],
        });


        function statusChange(id){
            let status = $('#status-'+id).find(":selected").val()
            if (confirm("Are you sure") == true) {
                $.ajax({
                    type:'GET',
                    url:"{{ route('news-status-change') }}",
                    data:{
                        id:id,
                        status:status
                    },
                    success:function(data){
                        toastr.success("Status Change successfully");
                    }
                });



            } else {

            }
        }

        $("#search-btn").on('click', function () {
            datatable.clear().draw();

        });

        // delete Confirm
        function showDeleteConfirm(id) {
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    deleteItem(id);
                }
            });
        };

        // Delete Button
        function deleteItem(id) {

            var url = '{{ route("news.destroy",":id") }}';
            $.ajax({
                type: "DELETE",
                url: url.replace(':id', id),
                success: function (resp) {
                    console.log(resp);
                    // Reloade DataTable
                    $('#table').DataTable().ajax.reload();
                    if (resp.success === true) {
                        // show toast message
                        toastr.success(resp.message);
                    } else if (resp.errors) {
                        toastr.error(resp.errors[0]);
                    } else {
                        toastr.error(resp.message);
                    }
                }, // success end
                error: function (error) {
                    location.reload();
                } // Error
            })
        }
    </script>
@endsection
