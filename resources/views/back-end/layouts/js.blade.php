<script src="{{asset('back-end/js/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('back-end/js/jquery-ui.min.js')}}"></script>

<!-- Bootstrap 3.3.7 -->
<script src="{{asset('back-end/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{asset('back-end/js/raphael.min.js')}}"></script>
<script src="{{asset('back-end/js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('back-end/js/jquery.sparkline.min.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('back-end/js/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('back-end/js/moment.min.js')}}"></script>
<script src="{{asset('back-end/js/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('back-end/js/bootstrap-datepicker.min.js')}}"></script>

<!-- Slimscroll -->
<script src="{{asset('back-end/js/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('back-end/js/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('back-end/js/adminlte.min.js')}}"></script>

<!-- Select2 -->
<script src="{{asset('back-end/js/select2.full.min.js')}}"></script>

<!-- DataTables -->
<script src="{{asset('back-end/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('back-end/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('back-end/js/dataTables.bootstrap.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>


<script>
    $.widget.bridge('uibutton', $.ui.button);
    $('.select2').select2();

    //Date picker
    $('.datepicker').datepicker({
        autoclose: true
    })

    @if(Session::has('success'))

    toastr.success("{{ Session::get('success') }}");

    @endif



    @if(Session::has('info'))

    toastr.info("{{ Session::get('info') }}");

    @endif



    @if(Session::has('warning'))

    toastr.warning("{{ Session::get('warning') }}");

    @endif



    @if(Session::has('error'))

    toastr.error("{{ Session::get('error') }}");

    @endif


</script>