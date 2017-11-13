@extends('layouts.header')
  @section('content')
   <body>
      <div id="app">
         <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
               <div class="navbar-header">
                  <!-- Branding Image -->
                  <a class="navbar-brand" href="{{ url('/') }}">
                  {{ config('app.name', 'Laravel') }}
                  </a>
               </div>
            </div>
         </nav>
         <div class="container">
            <div class="row">
               <div class="col-md-8 col-md-offset-2">
                  <div class="panel panel-default">
                     <div class="panel-heading">Angular</div>
                     <div class="panel-body">
                       <div class="container">
                         <div class="row">
                           <div class="col-md-12">
                              <form name="myForm"  method="POST" ng-controller="HomeController">
                                 {{csrf_field()}}
                                 <div class="form-group">
                                    <label> Customer Name :   </label>
                                    <input type="text" class="input-lg" ng-model="username"> 
                                 </div>
                                 <div class="form-group">
                                    <label> Customer Email :   </label>
                                    <input type="password"  name="email" class="input-lg" ng-model="password"> 
                                 </div>

                                 <div class="form-group">
                                   <button type="button" class="btn btn-primary" ng-click="login()">Submit</button>
                                 </div>                                
                              </form>
                           </div>
                         </div>
                       </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Scripts -->
   </body>
@endsection