<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Management | Dashboard</title>
    @include('admin.common.head')
</head>


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <!-- <img class="animation__shake" src="{{ asset('admin/theme/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60"> -->
        </div>

        <!--Header-->
        @include('admin.common.header')
        <!--End-Header-->


        <!-- Main Sidebar Container -->
        @include('admin.common.sidebar_menu')
        <!--End-Main Sidebar Container-->


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ __('Dashboard') }}</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            @yield('content')
        </div>
        <!-- Page Content Section End -->
    </div>

    <!-- Javascript Section  -->

    <!-- /.content-wrapper -->
    @include('admin.common.footer')
    @include('admin.common.script')
    @yield('page_specific_js')

</body>

</html>
