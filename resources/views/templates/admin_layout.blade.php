<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Library | @yield('title', 'Home Page')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin_panel/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin_panel/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('admin_panel/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin_panel/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item">
                <form method="post" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="nav-link" style="background: transparent;border:none">
                        Logout
                    </button>
                </form>
            </li>
        </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('home') }}" class="brand-link">
            <span class="brand-text font-weight-light">Library</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('admin_panel/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                         alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Alexander Pierce</a>
                </div>
            </div> -->

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    @if (auth('admins')->check())
                        <li class="nav-item">
                            <a href="{{ route('admin.users') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.librarians') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Librarians</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.teachers') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Teachers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.admins') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Admins</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.libraries') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Libraries</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.books') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Books</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.magazines') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Magazines</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.payment_requests') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Payment Requests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.rent_requests') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Rent Requests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.book_requests') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Book Requests</p>
                            </a>
                        </li>

                    @elseif (auth('librarians')->check())
                        <li class="nav-item">
                            <a href="{{ route('librarian.books') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Books</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('librarian.payment_requests') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Payment Requests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('librarian.rent_requests') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Rent Requests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('librarian.book_requests') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Book Requests</p>
                            </a>
                        </li>
                    @elseif (auth('teachers')->check())
                        <li class="nav-item">
                            <a href="{{ route('teacher.messages') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Messages</p>
                            </a>
                        </li>
                    @endif

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    @yield('content')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('admin_panel/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin_panel/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('admin_panel/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_panel/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_panel/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin_panel/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin_panel/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin_panel/js/demo.js') }}"></script>
<!-- page script -->
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>
</body>
</html>
