@extends('back-end.layouts.master')
@section('content-header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">

    <h1 style="font-family: 'Arial Narrow';">
        Ads
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pie-chart"></i> Dashboard</a></li>
        <li class="active">ads</li>
    </ol>
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h5 class="box-title"><b>ads List</b></h5>
            <a href="{{route('ads.create')}}" id="add_new" style="float: right" class="btn btn-sm btn-grad">Create Ads</a>
        </div>
        <div class="box-body">
            <table style="width: 100%" class="table table-responsive table-striped data-table" id="table">
                <thead class="table-header-background" style=";">
                <tr class="" style="text-align:center; ">
                    <th style="width: 5%">SL</th>
                    <th style="width: 15%">Banner</th>
                    <th style="width: 15%">title</th>
                    <th style="width: 15%">Link</th>
                    <th style="width: 20%">Description</th>
                    <th style="width: 15%">Status</th>
                    <th style="width: 15%">Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="padding: 20px">
                <form method="post" action="{{route('add-new-image-gallery')}}">
                    @csrf
                    <div class="">
                        <input type="hidden" name="gallery_id" id="gallery_id">
                        <label for="">Image</label><span style="font-weight: bold; color: red"> *</span>
                        <div id="dropzoneForm" class="dropzone">
                            <div id="image-body">

                            </div>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary" style="margin-top: 10px">Upload</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

    <script>
        $(document).ready(function () {
            $("#side-ades").addClass('active');
            $("#side-ades").addClass('active-sidebar');
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
                url: "{{route('ads.index')}}",
                type: "get",
            },

            columns: [
                {data: "DT_RowIndex", name: "DT_RowIndex", orderable: false,},
                {data: 'image', name: 'image', orderable: true,},
                {data: 'title', name: 'title', orderable: true,},
                {data: 'link', name: 'link', orderable: true},
                {data: 'description', name: 'description', orderable: true},
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
                    url:"{{ route('ads-status-change') }}",
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

            var url = '{{ route("ads.destroy",":id") }}';
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

        function addImage(id) {
            $('#gallery_id').val(id)
            $('.bd-example-modal-lg').modal('show');
        }
    </script>
    <script type="text/javascript">

        Dropzone.options.dropzoneForm = {
            url: "no-path",
            autoProcessQueue: false,
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
            addRemoveLinks: true,
            parallelUploads: 10,
            maxFilesize: 10,
            maxFiles: 2,
            init: function () {
                this.on("addedfile", (file) => {
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = event => {
                        $('#image-body').append(`<input type="hidden" name="image[]" value="${event.target.result}" id="image">`)
                    }
                });

            },

        };

    </script>

@endsection
