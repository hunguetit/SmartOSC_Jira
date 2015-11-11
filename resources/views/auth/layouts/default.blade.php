<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        @include('auth.includes.head')

        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        @include('auth.includes.script')      
        <!-- END JAVASCRIPTS -->
    </head>

    <body class="page-header-fixed page-quick-sidebar-over-content">
        <div class="clearfix">
        </div>

        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            @yield('content')
            <!-- END CONTENT -->
        </div>
    </body>
</html>