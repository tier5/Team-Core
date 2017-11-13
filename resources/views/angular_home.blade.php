@extends('layouts.header')
  @section('content')
   <body>
      <div id="app">
         <nav class="navbar navbar-default navbar-static-top" ng-controller="LoginController">
            <div class="container">
                @if(Session::has('user_id'))
                   <div class="navbar-header">
                      <!-- Branding Image -->
                      <a class="navbar-brand" href="" ng-click="dashboard()">
                      {{ config('app.name', 'Laravel') }}
                      </a>
                      <a class="navbar-brand" ng-click="index()" href=""> 
                      Users
                      </a>
                     
                   </div>
                   <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav navbar">
                            <li><a > Welcome : {{Session::get('user_name')}} </a> </li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right" >
                            <li><a  href="" ng-click="logout()">Logout</a></li>
                        </ul>
                    </div>
                @endif
            </div>
         </nav>
         <div class="container" ng-controller="ImageController">
            <div class="row">
              <div class="panel-heading">Slideshow</div>
                <div class="slider">
                  <img ng-repeat="slide in slides" bg-image class="slide"
                               ng-hide="!isCurrentSlideIndex($index)" ng-src="@{{slide.src}}">
                  <a class="arrow prev" href="" ng-click="nextSlide()"></a>
                  <a class="arrow next" href="" ng-click="prevSlide()"></a>
                  <nav class="slider-nav">
                    <div class="wrapper">
                      <ul class="dots">
                        <li class="dot" ng-repeat="slide in slides">
                          <a href="" ng-class="{'active':isCurrentSlideIndex($index)}"  ng-click="setCurrentSlideIndex($index);">@{{slide.description}}</a>
                        </li>
                             </ul>
                          </div>
                        </nav>
                      </div>
                </div>
            
         </div>

         <div ng-view=""> </div>
      </div>

      <!-- Scripts -->
   </body>
@endsection