// Define the `phonecatApp` module
var AngularApp = angular.module('AngularApp', ['ngRoute' , 'ngAnimate' , 'ui.bootstrap', 'ngMessages']).constant('API_URL' , 'http://127.0.0.1:8000');


/*to provide routes to the app */
AngularApp.config(function($routeProvider) 
{
  $routeProvider
    .when('/login' ,
    {
      templateUrl : '/user-login',
    })
    .when('/dashboard' ,
    {
      templateUrl : '/dashboard',
      controller: 'HomeController'
    })
    .when('/index' ,
    {
      templateUrl : '/index',
      controller: 'HomeController'
    })
    .otherwise({ redirectTo : '/'});

});

  
AngularApp.controller('HomeController', function($scope, $http, $window, API_URL, $location, $anchorScroll)
{

  $scope.editUser=[];
  $scope.showModal=false;

  /*to reload all the users */ 
  $scope.getUsers= function()
  {
    $http.get(API_URL+ "/users")
    .then(function (response){
      $scope.users = response.data;
     // console.log($scope.users);
     });
  };

  /*to add a new user */ 
  $scope.addUser = function()
  {
      url = "/add-user";

      $http({
        method: 'POST',
        url: url,
        data : $.param($scope.newUser),
        dataType: 'json',
        headers: {
          'Content-Type' : 'application/x-www-form-urlencoded'
        }
      }).then(function (response){
         toastr.success('User added successfully', 'Success Alert', {timeOut: 5000});
          $scope.getUsers();
          console.log(response);
          //location.reload();
        },function(error)
        {
          toastr.error('User not added', 'Error Alert', {timeOut: 5000});
          console.log(error);
        }); 

      $scope.showModal = false;     
      $window.scrollTo(0,0);
  };



  /*to edit a user */ 
  $scope.updateUser = function()
  {
     
      //console.log(id);
      url = "/update/"+$scope.editUser.id;
      var update_data = {
          name : $scope.editUser.name,
          email : $scope.editUser.email,
          password : $scope.editUser.password,
        } ;
      //console.log(update_data);
      $http({
        method: 'POST',
        url: url,
        data : JSON.stringify(update_data),
        dataType: 'json',
        headers: {
          'Content-Type' : 'application/json'
        }
      }).then(function (response){
         toastr.success('User updated successfully', 'Success Alert', {timeOut: 5000});
          $scope.getUsers();
          console.log(response);
          //location.reload();
        },function(error)
        {
          toastr.error('User not updated', 'Error Alert', {timeOut: 5000});
          console.log(error);
        }); 

      $scope.editModal = false;     
  };

  $scope.openModal = function(id)
  {
      
      // console.log($scope.$eval(id));
      $scope[id]=true;
      //console.log(id +$scope.$eval(id));
      $location.hash(id);
      $anchorScroll();
      //$window.scrollTo(0, angular.element(id).offsetTop); 
  };

  $scope.closeModal = function(id)
  {
    $scope[id]=false;
   // $window.scrollTo(0,0);
    $location.hash("");
    $anchorScroll();
  };

  $scope.openEditModal = function(id, user)
  {
      console.log(id);
      $scope[id]=true;
      $scope.editUser.name=user.name;
      $scope.editUser.email=user.email;
      $scope.editUser.id= user.id;
      $scope.editUser.password= user.password;
      //console.log($scope.editUser);
      // console.log();
      
      $location.hash(id);
      $anchorScroll();
      // $window.scrollTo(0, angular.element(id).offsetTop);   
  };



  /*to delete an existing user */ 
  $scope.confirmDelete = function(id)
  {
    //console.log(id);
    var c= confirm('Are you sure you want to delete ?');
    if(c)
    {
      $http({
        method: 'DELETE',
        url: API_URL + '/users/' + id 
        }).then(function (response){
          //console.log(response);
          toastr.error('User deleted successfully', 'Success Alert', {timeOut: 5000});
          $scope.getUsers();
        },function(error)
        {
          toastr.error('User not deleted', 'Error Alert', {timeOut: 5000});
          console.log(error);
        });      
    }
    else
    {
      return false;
    }
  };

  $scope.submitAddForm = function(isValid)
  {

    $scope.submitted=true;
    if(isValid)
    {
      //alert('Our form is amazing');
      toastr.success('Form submitted', 'Success Alert', {timeOut: 1000});
      $scope.addUser();
    }
   
  };

  $scope.submitEditForm = function(isValid)
  {

    $scope.editSubmitted=true;
    if(isValid)
    {
      //alert('Our form is amazing');
      toastr.success('Form submitted', 'Success Alert', {timeOut: 1000});
      $scope.updateUser();
    }
    //console.log($scope.editSubmitted);
  };



});

AngularApp.directive('passwordFormatValidator', function() 
{
  return {
        require : 'ngModel',
        link : function(scope, element, attrs, ngModel) {
          ngModel.$parsers.push(function(value) {
            //console.log(value.length);
            ngModel.$setValidity('required' ,!value || (value.length == 0));
            return value;
            // if(!value || value.length == 0) return;
            ngModel.$setValidity('digit', /[0-9]/.test(value)); 
            //ngModel.$setValidity('case', /[A-Z]/.test(value) && /[a-z]/.test(value)); 
            //ngModel.$setValidity('special', /[^a-z0-9 ]/i.test(value)); 
            return value;
        });
    }
  };
});



/*controller for login of user */

AngularApp.controller('LoginController', function($scope, $http, API_URL, $location , $window)
{
  $scope.login = function()
  {
    console.log("Login");
    console.log($scope.loginUser);

    url = "/user-login";

    $http({
      method: 'POST',
      url: url,
      data : $.param($scope.loginUser),
      dataType: 'json',
      headers: {
        'Content-Type' : 'application/x-www-form-urlencoded'
      }
    }).then(function (response){
        if(response.data==1)
        {
          toastr.success('User logged in successfully', 'Success Alert', {timeOut: 5000});
          console.log(response);
          // $location.path('/');
          $window.location ="./";

        }
        else 
        {
          toastr.error('User not logged in successfully', 'Error Alert', {timeOut: 5000});
          console.log(response);
        }
    },function(error)
    {
      toastr.error('User not logged in', 'Error Alert', {timeOut: 5000});
      console.log(error);
    }); 

  };
  $scope.logout = function()
  {
    console.log("Logout");

    url = "/user-logout";

    $http({
      method: 'GET',
      url: url,
      headers: {
        'Content-Type' : 'application/x-www-form-urlencoded'
      }
    }).then(function (response){
      toastr.success('User logged out successfully', 'Success Alert', {timeOut: 5000});
      $window.location ="./userLogin";
    },function(error)
    {
      toastr.error('User not logged out', 'Error Alert', {timeOut: 5000});
      console.log(error);
    }); 

  };

  /*to go to the user dashboard */
  $scope.dashboard = function()
  {
    $location.path( "/dashboard" ).replace();
  };

  $scope.index = function()
  {
    $location.path( "/index" ).replace(); 
  };

});



AngularApp.controller('ImageController', function ($scope, $timeout) {
   
       $scope.slides = [{id:"image00", src:"./images/image1.jpeg"},
        {id:"image01", src:"./images/image2.jpeg"},
        {id:"image02", src:"./images/image5.jpeg"},
        {id:"image03", src:"./images/image3.jpeg"},
        {id:"image04", src:"./images/image4.jpeg"}];

        $scope.direction = 'left';
        $scope.currentIndex = 0;

        $scope.setCurrentSlideIndex = function (index) {
            $scope.direction = (index > $scope.currentIndex) ? 'left' : 'right';
            $scope.currentIndex = index;
        };

        $scope.isCurrentSlideIndex = function (index) {
            return $scope.currentIndex === index;
        };

        $scope.prevSlide = function () {
            $scope.direction = 'left';
            $scope.currentIndex = ($scope.currentIndex < $scope.slides.length - 1) ? ++$scope.currentIndex : 0;
        };

        $scope.nextSlide = function () {
            $scope.direction = 'right';
            $scope.currentIndex = ($scope.currentIndex > 0) ? --$scope.currentIndex : $scope.slides.length - 1;
        };
});
AngularApp.animation('.slide-animation', function () {
        return {
            beforeAddClass: function (element, className, done) {
                var scope = element.scope();

                if (className == 'ng-hide') {
                    var finishPoint = element.parent().width();
                    if(scope.direction !== 'right') {
                        finishPoint = -finishPoint;
                    }
                    TweenMax.to(element, 0.5, {left: finishPoint, onComplete: done });
                }
                else {
                    done();
                }
            },
            removeClass: function (element, className, done) {
                var scope = element.scope();

                if (className == 'ng-hide') {
                    element.removeClass('ng-hide');

                    var startPoint = element.parent().width();
                    if(scope.direction === 'right') {
                        startPoint = -startPoint;
                    }

                    TweenMax.fromTo(element, 0.5, { left: startPoint }, {left: 0, onComplete: done });
                }
                else {
                    done();
                }
            }
        };
});

AngularApp.directive('bgImage', function ($window, $timeout) {
    return function (scope, element, attrs) {
        var resizeBG = function () {
        
          element.css({
            width: '920px',
            height:  '300px',
            margin: '20px',
          });
            
        };

        var windowElement = angular.element($window);
        windowElement.resize(resizeBG);

        element.bind('load', function () {
            resizeBG();
        });
    }
});
