@php
    $time_left = strtotime(session('contest_end')) - time();
    $time_left = $time_left > 0 ? $time_left : 0;
@endphp
<html>
    <head>
        <title>Math quest</title>
        
        @yield('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/a7f8da719b.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    </head>
    <body class="sidebar-mini layout-fixed layout-navbar-fixed sidebar-open">
         
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light flex-row">
            <!-- Left navbar links -->
                <ul class="navbar-nav pl-3">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item ml-2">
                        <h3>@yield('title')</h3>
                    </li>
                </ul>
                <div class="ml-auto">
                    <h3 id="time_left"></h3>
                </div>
            </nav>
  <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="#" class="brand-link">
                    <span class="brand-text font-weight-light">Math quest</span>
                </a>
                <div class="sidebar">
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                            <li class="nav-item disabled brand-link">
                                <h3 style="color:white">
                                    {{session('team_name')}}
                                </h3>
                            </li>
                            <li class="nav-item">
                                <a href="/" class="nav-link {{ session('page')=='/' ? 'active' : ''}}">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Home
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('leaderboard')}}" class="nav-link {{ session('page')=='leaderboard' ? 'active' : ''}}">
                                    <i class="nav-icon fas fa-trophy"></i>
                                    <p>
                                        Leaderboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="{{route('problemset')}}" class="nav-link {{ session('page')=='problemset' ? 'active' : ''}}">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Problem set
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('submissions')}}" class="nav-link {{ session('page')=='submissions' ? 'active' : ''}}">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>
                                        Submissions
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('logout')}}" class="nav-link">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>
                                        Logout
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                    <!-- /.sidebar -->
                </div>
            </aside>
            
            <div class="content-wrapper p-3">
                @yield('content')
            </div>
            
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        var time_left = {{$time_left}};

        function time_left_string(){
            var hours = Math.floor(time_left/3600);
            var minutes = Math.floor((time_left%3600)/60);
            var seconds = time_left%60;
            if(time_left<=0){
                return "Contest is end";
            }
            return "Time left: "+ hours + ":" + minutes + ":" + seconds;
        }
        function update_time_left(){
            if(time_left>0){
                time_left--;
            }
            $('#time_left').text(time_left_string());
        }
        setInterval(update_time_left, 1000);
    </script>
    @yield('scripts')
</html>