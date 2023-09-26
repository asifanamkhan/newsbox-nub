
<!-- Sidebar toggle button-->
<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
</a>

<a target="_blank" href="{{\Illuminate\Support\Facades\URL::asset('/')}}" style="position: relative; margin: 10px 0 0 10px" class="btn btn-sm btn-success">Website</a>

<div class="navbar-custom-menu">

    <ul class="nav navbar-nav">

        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu" >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{asset('public/back-end/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                <span  class="hidden-xs">Inventory</span>
            </a>
            <ul class="dropdown-menu" >
                <!-- User image -->
                <li class="user-header" style="background: linear-gradient(90deg,#667eea 0,#764ba2);">
                    <img src="{{asset('public/back-end/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                    <p >
                        Admin
                        <small>Member since </small>
                    </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                    <div class="row">
                        <div class="col-xs-4 text-center">
                            <a href="#">Followers</a>
                        </div>
                        <div class="col-xs-4 text-center">
                            <a href="#">Sales</a>
                        </div>
                        <div class="col-xs-4 text-center">
                            <a href="#">Friends</a>
                        </div>
                    </div>
                    <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="pull-left">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                        <form id="logout-form" action="" method="POST" class="d-none">
                            @csrf
                            <button href="#" class="btn btn-default btn-flat">Sign out</button>
                        </form>

                    </div>
                </li>
            </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
    </ul>
</div>