<!DOCTYPE html>
<html xmlns:th="http://www.thymeleaf.org">

<div>
    @include('template/head')
</div>

<!-- Editable CSS -->
<link rel="stylesheet" type="text/css"
      href="{{asset('/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css"
      href="{{asset('/css/responsive.dataTables.min.css')}}">
<link href="{{asset('/css/login-register-lock.css')}}" rel="stylesheet">
<link href="{{asset('/css/jquery.toast.css')}}" rel="stylesheet">
<!-- Custom CSS -->
<link href="{{asset('/css/style.min.css')}}" rel="stylesheet">
<!-- page css -->
<link href="{{asset('/css/pages/inbox.css')}}" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="skin-blue fixed-layout">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">CRM</p>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div>
        @include('template/header')
    </div>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <div>
        @include('template/left-sidebar')
    </div>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div>
                @include('template/page-titles')
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            @yield('content')
            <!-- ============================================================== -->
            <!-- End Page Content -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <div>
                @include('template/right-sidebar')
            </div>
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <div>
        @include('template/footer')
    </div>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->

{{--<script th:inline="javascript">--}}
{{--    var home = /*[[${home}]]*/ null;--}}
{{--</script>--}}

<script src="{{asset('/js/library/jquery-3.2.1.min.js')}}" type="text/javascript">></script>
<!--    &lt;!&ndash; Bootstrap tether Core JavaScript &ndash;&gt;-->
<script src="{{asset('/js/library/popper.min.js')}}" type="text/javascript">></script>
<script src="{{asset('/js/library/bootstrap.min.js')}}" type="text/javascript">></script>
<!--    &lt;!&ndash; slimscrollbar scrollbar JavaScript &ndash;&gt;-->
<script src="{{asset('/js/library/perfect-scrollbar.jquery.min.js')}}" type="text/javascript">></script>
<!--Wave Effects -->
<script src="{{asset('/js/library/waves.js')}}" type="text/javascript">></script>
<!--Menu sidebar -->
<script src="{{asset('/js/library/sidebarmenu.js')}}" type="text/javascript">></script>
<!--stickey kit -->
<script src="{{asset('/js/library/sticky-kit.min.js')}}"></script>
<script src="{{asset('/js/library/jquery.sparkline.min.js')}}" type="text/javascript">></script>
<!--Custom JavaScript -->

<script src="{{asset('/js/library/custom.min.js')}}" type="text/javascript">></script>
<script src="{{asset('/js/library/jquery.toast.js')}}"></script>
<script src="{{asset('/js/library/toastr.js')}}"></script>
<!-- Editable -->
<script src="{{asset('/js/library/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/js/library/dataTables.responsive.min.js')}}"></script>
@yield('script')
<script>
    $('#config-table').DataTable({
        responsive: true
    });
</script>
</body>
</html>
