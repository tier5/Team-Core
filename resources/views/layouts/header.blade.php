<!DOCTYPE html>
<html lang="en" ng-app="AngularApp">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Laravel') }}</title>
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
     <link type="text/css" rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
  
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script><!-- Date Range picker JavaScript -->
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.0/angular.min.js"></script>
     <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.6.0/angular-route.js"></script>

     <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.0/angular.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.0/angular-route.min.js"></script>

     <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-scroll/1.0.0/angular-scroll.min.js"></script>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.0/angular-animate.js" ></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.0/angular-animate.min.js" ></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.5.0/ui-bootstrap-tpls.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.5.0/ui-bootstrap.js"></script>
    
     <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.5.0/ui-bootstrap.min.js"></script>
     <script src="http://code.createjs.com/preloadjs-0.4.1.min.js"></script>

     <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular-touch.min.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.7/angular-messages.js"></script>
     <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.10.3/TweenMax.min.js"></script>
     <script src="<?= asset('js/script.js')?>"></script>
   </head>
   @yield('content')

</html>