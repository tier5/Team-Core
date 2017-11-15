<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ecommerce</title>

    <!-- Bootstrap Core CSS -->
    {!!HTML::style('admintheam/vendor/bootstrap/css/bootstrap.min.css')!!}
    <!-- MetisMenu CSS -->
    {!!HTML::style('admintheam/vendor/metisMenu/metisMenu.min.css')!!}
    <!-- Custom CSS -->
    {!!HTML::style('admintheam/dist/css/sb-admin-2.css')!!}
    <!-- Custom Fonts -->
    {!!HTML::style('admintheam/vendor/font-awesome/css/font-awesome.min.css')!!}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @stack('css')

</head>
<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="javascript:void(0);">Ecommerce</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               
                <!-- <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    
                </li> -->
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <!-- Navigation -->
            @include('layouts.sidebar')
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Page Content -->
        @yield('content')
        <!-- /#page-wrapper -->
</div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    {!!HTML::script('admintheam/vendor/jquery/jquery.min.js')!!}
    <!-- Bootstrap Core JavaScript -->
    {!!HTML::script('admintheam/vendor/bootstrap/js/bootstrap.min.js')!!}
    <!-- Metis Menu Plugin JavaScript -->
    {!!HTML::script('admintheam/vendor/metisMenu/metisMenu.min.js')!!}
    <!-- Custom Theme JavaScript -->
    {!!HTML::script('admintheam/dist/js/sb-admin-2.js')!!}
    <!-- bootbox alert -->
    {!! HTML::script('js/bootbox.min.js') !!}
    {!! HTML::script('js/sweetalert.min.js') !!}
    @stack('scripts')
</body>

</html>
