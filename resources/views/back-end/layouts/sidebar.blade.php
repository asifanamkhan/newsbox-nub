<section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="">
            <a href="">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <span class="pull-right-container">
            </span>
            </a>
        </li>
        @can('settings')
            <li id="side-settings" class="treeview ">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>Settings</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    @endcan
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
                        <a href="{{route('social-link.index')}}">
                            <i class="fa fa-circle-o"></i>
                            Social Media Link
                        </a>
                    </li>

                    <li id="side-important-link" class="">
                        <a href="{{route('important-links.index')}}">
                            <i class="fa fa-circle-o"></i>
                            Important Links
                        </a>
                    </li>
                </ul>
            </li>

            @can('slide')
                <li id="side-slide" class="treeview">
                    <a href="#">
                        <i class="fa fa-image"></i>
                        <span>Slide</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li id="side-banner-slide" class="">
                            <a href="{{route('slides.index')}}">
                                <i class="fa fa-circle-o"></i>
                                Banner Slide
                            </a>
                        </li>
                        <li id="side-featured-slide" class="">
                            <a href="{{route('featured-slides.index')}}">
                                <i class="fa fa-circle-o"></i>
                                Featured Slide
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('news')
                <li id="side-news" class="treeview">
                    <a href="#">
                        <i class="fa fa-newspaper-o"></i>
                        <span>News</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li id="side-category" class="">
                            <a href="{{route('category.index')}}">
                                <i class="fa fa-circle-o"></i>
                                Category
                            </a>
                        </li>
                        <li id="side-newstype" class="">
                            <a href="{{route('newstype.index')}}">
                                <i class="fa fa-circle-o"></i>
                                News Type
                            </a>
                        </li>
                        <li id="side-news-news" class="">
                            <a href="{{route('news.index')}}">
                                <i class="fa fa-circle-o"></i>
                                News
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('admin')
                <li id="side-administrators" class="treeview">
                    <a href="#">
                        <i class="fa fa-user-circle-o"></i>
                        <span>Administrators</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li id="side-admin" class="">
                            <a href="{{route('users.index')}}">
                                <i class="fa fa-circle-o"></i>
                                Admins
                            </a>
                        </li>
                        <li id="side-role" class="">
                            <a href="{{route('roles.index')}}">
                                <i class="fa fa-circle-o"></i>
                                Role
                            </a>
                        </li>
                        <li id="side-permissions" class="">
                            <a href="{{route('permissions.index')}}">
                                <i class="fa fa-circle-o"></i>
                                Permission
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('user')
                <li id="side-users" class="treeview">
                    <a href="#">
                        <i class="fa fa-users"></i>
                        <span>Users</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li id="side-contactus" class="">
                            <a href="{{route('contactus.index')}}">
                                <i class="fa fa-circle-o"></i>
                                Contact Us
                            </a>
                        </li>
                        <li id="side-newsletter" class="">
                            <a href="{{route('newsletter.index')}}">
                                <i class="fa fa-circle-o"></i>
                                Newsletter
                            </a>
                        </li>
                        <li id="side-readers" class="">
                            <a href="{{route('readers.index')}}">
                                <i class="fa fa-circle-o"></i>
                                Readers
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('gallery')
                <li class="" id="side-gallery">
                    <a href="{{route('gallery.index')}}">
                        <i class="fa fa-folder-open"></i> <span>Gallery</span>
                        <span class="pull-right-container">
            </span>
                    </a>
                </li>
            @endcan
            @can('ads')
                <li class="" id="side-ades">
                    <a href="{{route('ads.index')}}">
                        <i class="fa fa-folder-open"></i> <span>Ads</span>
                        <span class="pull-right-container">
            </span>
                    </a>
                </li>
            @endcan
            @can('events')
                <li class="" id="side-events">
                    <a href="{{route('events.index')}}">
                        <i class="fa fa-calendar"></i> <span>Events</span>
                        <span class="pull-right-container">
            </span>
                    </a>
                </li>
            @endcan
            @can('achievements')
                <li class="" id="side-achievements">
                    <a href="{{route('achievements.index')}}">
                        <i class="fa fa-trophy"></i> <span>Achievements</span>
                        <span class="pull-right-container">
            </span>
                    </a>
                </li>
            @endcan
            <li class="" id="side-notice">
                <a href="{{route('notice.index')}}">
                    <i class="fa fa-circle-o-notch"></i> <span>Notice</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
    </ul>
</section>
