<?php
$settings = App\Models\Setting::latest()->first();
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$settings->site_name ?? 'No Site Name'}}</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="{{asset('admin/assets/plugins/fontawesome-free/css/all.min.css')}}"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Ionicons -->
    {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
    <!-- Tempusdominus Bootstrap 4 -->
    {{-- <link rel="stylesheet" href="{{asset('admin/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/jqvmap/jqvmap.min.cs')}}s"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/assets/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    {{-- <link rel="stylesheet" href="{{asset('admin/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/summernote/summernote-bs4.min.css')}}"> --}}


    <!-- <link rel="stylesheet" type="text/css" href="/css/material.min.css"> -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>

    @yield('additional_styles')

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/admin/home" class="nav-link">Home</a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>


        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/admin/home" class="brand-link">
                @if($settings)
                @if( $settings->site_logo)
                <img src="{{asset('storage/settings/logo/'.$settings->site_logo)}}" alt="Site Logo" class="brand-image elevation-3" style="opacity: .8">

                @else
                {{$settings->site_name}}

                @endif
                @else
                Not Site Name
                @endif

                {{-- <span class="brand-text font-weight-light">{{$settings->site_name}}</span> --}}
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <hr>
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if (auth()->check() && auth()->user()->image)
                        <img class="profile-user-img img-fluid img-circle" src="{{asset('/storage/profile/'.auth()->user()->image)}}" alt="User profile picture">
                        @else
                        <img class="profile-user-img img-fluid img-circle" src="{{asset('storage/profile/profile.png')}}" alt="User profile picture">
                        @endif
                    </div>
                    <div class="info">
                        <a href="/admin/home" class="d-block"> @if (auth()->check())
                            {{auth()->user()->name}}

                            @else
                            Guest User

                            @endif </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        @if (auth()->check() && auth()->user()->is_admin)
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa  fa-cog "></i>
                                <p>
                                    Settings
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('settings.update.form')}}" class="nav-link">
                                        <i class="fa  fa-cog nav-icon"></i>
                                        <p>GeneraL Settings</p>
                                    </a>
                                </li>


                            </ul>
                        </li>

                        <!-- for category -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list-alt "></i>
                                <p>
                                    Category
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.category.getCategories')}}" class="nav-link">
                                        <i class="fa fa-list-alt nav-icon"></i>
                                        <p>Categories</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.category.create.form')}}" class="nav-link">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Create Category</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        @endif




                        <!-- for post -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-newspaper "></i>
                                <p>
                                    Post
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.post.getPosts')}}" class="nav-link">
                                        <i class="fa fa-newspaper nav-icon"></i>
                                        <p>Posts</p>
                                    </a>
                                </li>



                                <li class="nav-item">
                                    <a href="{{route('admin.post.create.form')}}" class="nav-link">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Create Post</p>
                                    </a>
                                </li>



                            </ul>
                        </li>

                        <!-- for event -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-calendar "></i>
                                <p>
                                    Event
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (auth()->check() && auth()->user()->is_admin )
                                <li class="nav-item">
                                    <a href="{{route('admin.event.getEvents')}}" class="nav-link">
                                        <i class="fas fa-calendar nav-icon"></i>
                                        <p>Events</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('admin.event.create.form')}}" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Create Event</p>
                                    </a>
                                </li>

                                @endif



                            </ul>
                        </li>



                        <!-- for video -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-play "></i>
                                <p>
                                    Video Post
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{route('admin.video.getVideos')}}" class="nav-link">
                                        <i class="fas fa-play nav-icon"></i>
                                        <p>Video Posts</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('admin.video.create.form')}}" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Create Video Post</p>
                                    </a>
                                </li>





                            </ul>
                        </li>

                        @if (auth()->check() && auth()->user()->is_admin)

                        <li class="nav-item">
                            <a href="{{route('admin.user.getUsers')}}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.writer.requests')}}" class="nav-link">
                                <i class="nav-icon fas fa-edit "></i>
                                <p>
                                    Writer Requests
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.advert.requests')}}" class="nav-link">
                                <i class="nav-icon fas fa-edit "></i>
                                <p>
                                    Advert Requests
                                </p>
                            </a>
                        </li>


                        @endif


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->


        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                {{$settings->site_name?? 'No Site Name'}}
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; {{date('Y')}} <a href="/admin/home">{{$settings->site_name?? "No Site Name"}}</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    {{-- <script src="{{asset('admin/assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('admin/assets/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('admin/assets/plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('admin/assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('admin/assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('admin/assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('admin/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('admin/assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('admin/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script> --}}
    <!-- AdminLTE App -->
    <script src="{{asset('admin/assets/dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{asset('admin/assets/dist/js/demo.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('admin/assets/dist/js/pages/dashboard.js')}}"></script> --}}
    {{-- <script src="{{asset('/js/app.js')}}"></script> --}}
    <script src="https://cdn.jsdelivr.net/gh/moment/moment@develop/min/moment-with-locales.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>





    <script>
        ClassicEditor.create(document.querySelector('#ckeditor'),
        {
            ckfinder: {
                uploadUrl: "{{ route('ck.upload', ['_token'=> csrf_token()]) }}"
            }
        }
            )
            .catch(error => {
                console.error('CKEditor initialization error:', error);
            });
    </script>
    @yield('additional_scripts')

</body>

</html>
