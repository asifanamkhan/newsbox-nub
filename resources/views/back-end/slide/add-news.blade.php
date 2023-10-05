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
<table style="width: 100%" class="table table-responsive table-striped data-table-news" id="table">
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

<script>
    var slide_type = "{{$type}}"
    var slide_id = "{{$slide_id}}"
    var news_datatable = $('.data-table-news').DataTable({
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
            url: "{{route('add-news-to-slide')}}",
            type: "get",
            data: function (d) {
                d.date = $('#date').val(),
                d.category_id = $('#category_id').val(),
                d.type = $('#type').val(),
                d.title = $('#title').val(),
                d.slide_type = slide_type,
                d.slide_id = slide_id
            }
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

    $("#search-btn").on('click', function () {
        news_datatable.clear().draw();

    });

</script>