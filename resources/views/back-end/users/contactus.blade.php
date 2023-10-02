@extends('back-end.layouts.master')
@section('content-header')
    <h1 style="font-family: 'Arial Narrow';">
        Contact Us
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i>Users</a></li>
        <li class="active">contact us</li>
    </ol>
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h5 class="box-title"><b>Contact Us List</b></h5>
            {{--            <a href="{{route('category.create')}}" id="add_new" style="float: right" class="btn btn-sm btn-grad">Add News Category</a>--}}
        </div>
        <div class="box-body">
            <table style="width: 100%" class="table table-responsive table-striped data-table" id="table">
                <thead class="table-header-background" style=";">
                <tr class="" style="text-align:center; ">
                    <th style="width: 8%">SL</th>
                    <th style="width: 16%">Name</th>
                    <th style="width: 18%">Email</th>
                    <th style="width: 18%">Phone</th>
                    <th style="width: 20%">Subject</th>
                    <th style="width: 20%">Message</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#side-users").addClass('active');
            $("#side-contactus").addClass('active');
            $("#side-contactus").addClass('active-sidebar');
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
                url: "{{route('contactus.index')}}",
                type: "get",
            },

            columns: [
                {data: "DT_RowIndex", name: "DT_RowIndex", orderable: false,},
                {data: 'name', name: 'name', orderable: true,},
                {data: 'email', name: 'email', orderable: true,},
                {data: 'phone', name: 'phone', orderable: true,},
                {data: 'subject', name: 'subject', orderable: true,},
                {data: 'message', name: 'message', orderable: true,},
                //only those have manage_user permission will get access
            ],
        });


    </script>
@endsection
