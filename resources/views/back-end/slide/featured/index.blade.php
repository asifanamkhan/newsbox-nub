@extends('back-end.layouts.master')
@section('content-header')
    <h1 style="font-family: 'Arial Narrow';">
        Slide Featured News
    </h1>
    <h5>
        <b style="color: red">Ony 4 news can be featured ***</b>
    </h5>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i>News</a></li>
        <li class="active">news</li>
    </ol>
@endsection
@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h5 class="box-title"><b>Featured Slide List</b></h5>
            <button onclick="addNews()" href="" id="add_new" style="float: right" class="btn btn-sm btn-grad">Add New
                Featured Slide
            </button>
        </div>
        <div class="box-body">
            <table style="width: 100%" class="table table-responsive table-striped data-table-slide" id="table">
                <thead class="table-header-background" style=";">
                <tr class="" style="text-align:center; ">
                    <th style="width: 8%">SL</th>
                    <th style="width: 13%">Image</th>
                    <th style="width: 10%">Date</th>
                    <th style="width: 25%">Title</th>
                    <th style="width: 12%">Category</th>
                    <th style="width: 12%">Type</th>
                    <th style="width: 10%">Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="padding: 20px">

            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#side-slide").addClass('active');
            $("#side-featured-slide").addClass('active');
            $("#side-featured-slide").addClass('active-sidebar');
        });

    </script>

    <script>
        var slide_datatable = $('.data-table-slide').DataTable({
            order: [],
            lengthMenu: [[10, 20, 30, 50, 100, -1], [10, 20, 30, 50, 100, "All"]],
            processing: true,
            responsive: true,
            searching: false,
            serverSide: true,
            language: {
                processing: '<i class="ace-icon fa fa-spinner fa-spin bigger-500" style="font-size:60px;"></i>'
            },
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",

            ajax: {
                url: "{{route('featured-slides.index')}}",
                type: "get",

            },

            columns: [
                {data: "DT_RowIndex", name: "DT_RowIndex", orderable: false,},
                {data: 'image', name: 'image', orderable: false},
                {data: 'date', name: 'date', orderable: true},
                {data: 'title', name: 'title', orderable: true},
                {data: 'category_id', name: 'category_id', orderable: true},
                {data: 'type', name: 'type', orderable: true},
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

            var url = '{{ route("category.destroy",":id") }}';
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

        function addNews() {
            $.ajax({
                type: "get",
                url: "{{route('add-news-to-slides-modal')}}",
                data: {
                    type: 1,
                },
                success: function (resp) {
                    $('.modal-content').html(resp)
                    $('.bd-example-modal-lg').modal('show');
                }
            })
        }
    </script>
@endsection
