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
    {!!HTML::style('admintheam/font-awesome/css/font-awesome.min.css')!!}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @stack('css')
</head>
<body>
    @yield('content')


    <script src="{{ asset('js/app.js') }}"></script>
    <!-- login validation js -->
     {!!HTML::script('admintheam/vendor/jquery/jquery.min.js')!!}

    <!-- Bootstrap Core JavaScript -->
     {!!HTML::script('admintheam/vendor/bootstrap/js/bootstrap.min.js')!!}

    <!-- Metis Menu Plugin JavaScript -->
     {!!HTML::script('admintheam/vendor/metisMenu/metisMenu.min.js')!!}

    <!-- Custom Theme JavaScript -->
     {!!HTML::script('admintheam/dist/js/sb-admin-2.js')!!}

    @stack('scripts')
</body>
</html>
