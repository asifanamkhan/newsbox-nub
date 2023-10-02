@extends('back-end.layouts.master')
@section('content-header')
    <h1 style="font-family: 'Arial Narrow';">
       News Type
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i>News</a></li>
        <li class="active">news type</li>
    </ol>
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h5 class="box-title"><b>News Type List</b></h5>
            <a href="{{route('newstype.create')}}" id="add_new" style="float: right" class="btn btn-sm btn-grad">Add News Type</a>
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
            $("#side-newstype").addClass('active');
            $("#side-newstype").addClass('active-sidebar');
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
                url: "{{route('newstype.index')}}",
                type: "get",
            },

            columns: [
                {data: "DT_RowIndex", name: "DT_RowIndex", orderable: false,},
                {data: 'name', name: 'name', orderable: true,},
                {data: 'action', searchable: false, orderable: false}

                //only those have manage_user permission will get access

            ],
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

            var url = '{{ route("newstype.destroy",":id") }}';
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
