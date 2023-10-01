@extends('back-end.layouts.master')
@section('content-header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">

    <h1 style="font-family: 'Arial Narrow';">
        Events
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i> Dashboard</a></li>
        <li class="active">events</li>
    </ol>
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h5 class="box-title"><b>Events List</b></h5>
            <a href="{{route('events.create')}}" id="add_new" style="float: right" class="btn btn-sm btn-grad">Add New Events</a>
        </div>
        <div class="box-body">
            <table style="width: 100%" class="table table-responsive table-striped data-table" id="table">
                <thead class="table-header-background" style=";">
                <tr class="" style="text-align:center; ">
                    <th style="width: 7%">SL</th>
                    <th style="width: 15%">Image</th>
                    <th style="width: 20%">title</th>
                    <th style="width: 40%">Description</th>
                    <th style="width: 8%">Status</th>
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
            $("#side-events").addClass('active');
            $("#side-events").addClass('active-sidebar');
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
                url: "{{route('events.index')}}",
                type: "get",
            },

            columns: [
                {data: "DT_RowIndex", name: "DT_RowIndex", orderable: false,},
                {data: 'image', name: 'image', orderable: true,},
                {data: 'title', name: 'title', orderable: true,},
                {data: 'description', name: 'description', orderable: true,},
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
                        url:"{{ route('slide-status-change') }}",
                        data:{
                            id:id,
                            status:status
                        },
                        success:function(data){
                            if(data == 0){
                                toastr.warning("You can active more then 3 slide");
                            }else{
                                toastr.success("Status Change successfully");
                            }
                        }
                    });



            } else {

            }
        }
    </script>
@endsection
