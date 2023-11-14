<!doctype html>
<html lang="en">
<head>
    <title>NEWSPAPER</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

{{--    @include('layouts.vite')--}}
    @include('back-end.layouts.header')
    @include('back-end.layouts.css')
    @yield('css')
</head>
<body class="hold-transition skin-blue sidebar-mini" style="font-family: 'Arial Narrow', sans-serif">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a style="background: #112F65;" href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>IT</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>NUB NEWSBOX</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav style="background: #112F65;" class="navbar navbar-static-top">
            @include('back-end.layouts.nav')
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar" style="background: #1F2937;">
        <!-- sidebar: style can be found in sidebar.less -->
        @include('back-end.layouts.sidebar')
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @yield('content-header')
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            @yield('content')
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        @include('back-end.layouts.footer')
    </footer>

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    {{--    <div class="control-sidebar-bg"></div>--}}
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
@include('back-end.layouts.js')
@yield('js')
</body>

</html>
