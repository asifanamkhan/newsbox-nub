<section class="sidebar" >
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="">
            <a href="">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <span class="pull-right-container">
            </span>
            </a>
        </li>

        <li id="side-settings" class="treeview
           ">
            <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Settings</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li id="side-general" class="">
                    <a href="{{route('general-settings.index')}}">
                        <i class="fa fa-circle-o"></i>
                        General
                    </a>
                </li>
                <li id="side-about-us" class="">
                    <a href="{{route('about-us.index')}}">
                        <i class="fa fa-circle-o"></i>
                        About Us
                    </a>
                </li>
                <li id="side-social-link" class="">
                    <a  href="{{route('social-link.index')}}">
                        <i class="fa fa-circle-o"></i>
                        Social Media Link
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</section>