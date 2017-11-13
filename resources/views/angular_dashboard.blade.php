<div class="container" ng-controller="LoginController">
  <div class="row">
     <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
           <div class="panel-heading">Dashboard</div>
           <div class="panel-body">
              <div class="row">
                 <div class="col-md-12">
                    <div class="card-body">
                       Name : {{Session::get('user_name')}}
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </div>
</div>