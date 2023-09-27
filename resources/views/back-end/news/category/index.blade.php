@extends('back-end.layouts.master')
@section('content-header')
    <h1 style="font-family: 'Arial Narrow';">
        Category
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i>News</a></li>
        <li class="active">category</li>
    </ol>
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h5 class="box-title"><b>category List</b></h5>
            <a href="{{route('category.create')}}" id="add_new" style="float: right" class="btn btn-sm btn-grad">Add New Category</a>
        </div>
        <div class="box-body">
            <table style="width: 100%" class="table table-responsive table-striped data-table" id="table">
                <thead class="table-header-background" style=";">
                <tr class="" style="text-align:center; ">
                    <th style="width: 7%">SL</th>
                    <th style="width: 15%">name</th>
                    <th style="width: 10%">Action</th>
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
            $("#side-category").addClass('active');
            $("#side-category").addClass('active-sidebar');
        });

    </script>
    <script>
        var datatable = $('.data-table').DataTable({
            order: [],
            lengthMenu: [[10, 20, 30, 50, 100, -1], [10, 20, 30, 50, 100, "All"]],
            processing: true,
            responsive: true,
            serverSide: true,
            language: {
                processing: '<i class="ace-icon fa fa-spinner fa-spin bigger-500" style="font-size:60px;"></i>'
            },
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",

            ajax: {
                url: "{{route('category.index')}}",
                type: "get",
            },

            columns: [
                {data: "DT_RowIndex", name: "DT_RowIndex", orderable: false,},
                {data: 'name', name: 'name', orderable: true,},
                {data: 'action', searchable: false, orderable: false}

                //only those have manage_user permission will get access

            ],
        });
    </script>
@endsection