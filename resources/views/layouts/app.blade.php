<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WAGON UBTZ') }}</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/solid.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/regular.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.css') }}">
 
 
    <style>
    thead{
        background:#1e2c6b ;
        color: #fff !important;
    }
    .navbar-lightblue {
        background-color: #1e2c6b !important;
        color: #fff !important;
    }
    .nav-pills .nav-link.active, .nav-pills .show > .nav-link{
        background-color: #1e2c6b !important;
        color: #fff !important;
    }
    }
    a{
        color: #1e2c6b;
    }
    </style>
    @yield('style')
</head>

<body
    class="hold-transition sidebar-mini sidebar-open">
    <div class="wrapper" id="app">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom navbar-lightblue">
            <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color:white"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown" style="align:right;">
                    <a class="nav-link" href='#' data-toggle="dropdown" aria-expanded="false" style="color:white">
                 
                      <center>  <i class="fa fa-user"></i> {{  Auth::user()->name }}</center>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">Сайн уу  {{  Auth::user()->name }}</span>
                        <div class="dropdown-divider"></div>
                        <a href="config" class="dropdown-item  dropdown-footer"><i
                                class="fa fa-gear mr-2"></i><span> Тохиргоо мэдээлэл </span></a>
                        <a href='logout' style='color:red !important' class="dropdown-item dropdown-footer">
                            <i class="fa fa-close mr-2"></i> Системээс гарах</a>
                    </div>
                </li>
              </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar  elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="{{ asset('img/vagon.png') }}" alt="EXAM"
                    class="brand-image img-circle elevation-3" {{--style="opacity: .8"--}}>
                <span class="brand-text font-weight-light">{{ config('app.name', 'WAGON UBTZ') }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                   
                    <div class="info">
                       
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" style="font-size:16px;" data-widget="treeview" role="menu"
                        data-accordion="false">
    
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link ">
                            <i class="fa fa-home left"></i>
                                <p>Үндсэн бүртгэл</p>
                              
                                    <i class="fas fa-angle-left right"></i>
               
                            </a>
                       
                            <ul class="nav nav-treeview">
                            <li class="nav-item has-treeview"  style="margin-left:1rem;">
                                    <a   href="{{ route('company') }}" class="nav-link">
                                    <i class="fa fa-book left"></i>
                                        <p >
                                        Компани бүртгэл
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item has-treeview"  style="margin-left:1rem;">
                                    <a   href="#" class="nav-link">
                                    <i class="fa fa-book left"></i>
                                        <p >
                                        Вагон бүртгэл
                                        </p>
                                    </a>
                                </li>
                             
                              </ul>
                             
                        </li>
                      
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header"></section>
            <section class="content">
                @yield('content')
            </section>
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer" id="row2">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                NCH Department
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2022 <a href="ubtz.mn">UBTZ MN</a>.</strong> All rights reserved.
        </footer>
        <div class="modal " id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-body" style='margin-top:400px;'>
                <div id="ajax_loader">
                    <img src="{{asset('img/logoubtz.gif')}}" width="250" style="margin-left: 40%;">
                </div>
            </div>
        </div>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- AdminLTE App -->
    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @yield('script')
    <script>
    /** add active class and stay opened when selected */
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active');

    // for treeview
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('');

    </script>
</body>

</html>
