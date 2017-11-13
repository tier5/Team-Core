<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Laravel') }}</title>
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">

     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
     
  
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
     <script src="<?= asset('js/script.js')?>"></script>
   </head>
   <body>
      <div id="app">
         
         
                        <form action="/add-user" method="POST">
                          {{csrf_field()}}
                          <div class="form-group">
                            <label>  Email :   </label>
                            <input type="text" class="input-lg" name="name"> 
                          </div>
                          <div class="form-group">
                            <label>  Email :   </label>
                            <input type="text" class="input-lg" name="email"> 
                          </div>
                          <div class="form-group">
                            <label>  Password :   </label>
                            <input type="password" class="input-lg" name="password"> 
                          </div>
                          <div class="form-group">
                            <button type="submit"   class="btn btn-primary" >Submit</button>
                          </div>
                        </form>
       </div>          
      <!-- Scripts -->
   </body>
</html>