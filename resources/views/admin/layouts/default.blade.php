<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.includes.head')
    @include('admin.includes.script')
</head>

<body class="hold-transition skin-blue sidebar-mini">
        <div class="clearfix">
        </div>
    <div class="wrapper">
    @include('admin.includes.header')
    @include('admin.includes.sidebar')

    @yield('content')
    </div>
    <!-- /#wrapper -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
   
    <!-- END JAVASCRIPTS -->
    @include('admin.includes.footer')
</head>
</body>
</html>
