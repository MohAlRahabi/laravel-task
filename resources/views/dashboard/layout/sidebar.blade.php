<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{asset('images/logo.png')}}" alt="Website Logo" class="d-block" style="opacity: .8;width: 60%;margin: 0 auto;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{route('subscribers.index')}}" class="nav-link {{ \Illuminate\Support\Str::startsWith(request()->fullUrl(),route('subscribers.index')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Subscribers
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('blogs.index')}}" class="nav-link {{ \Illuminate\Support\Str::startsWith(request()->fullUrl(),route('blogs.index')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Blogs
                        </p>
                    </a>
                </li>

                {{--add new link--}}

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
