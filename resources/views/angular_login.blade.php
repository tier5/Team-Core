         <div class="container" ng-controller="LoginController">
            <div class="row">
               <div class="col-md-8 col-md-offset-2">
                  <div class="panel panel-default">
                     <div class="panel-heading">Angular</div>
                     <div class="panel-body">
                         <div class="row">
                           <div class="col-md-12">

                            <div  tabindex="-1" role="dialog" aria-hidden="true" id="editModal">
                                <div class="modal-dialog" >
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <div class="col-md-11">
                                        <h1 class="modal-title"> Login</h1>
                                      </div>
                                      <div class="col-md-1">
                                       
                                      </div>
                                    </div>
                                    <div class="modal-body">
                                      <form class="form-horizontal" role="form">
                                        {{ csrf_field()}}
                                        <div class="card mb-3">
                                          <div class="card-body">
                                            
                                            <div class="form-group">
                                              <label for="name" class="col-sm-2 control-label">Email</label>
                                              <div class="col-sm-10">
                                                <input type="text" class="form-control" id="email" placeholder="Your Email" ng-model="loginUser.email" " > 
                                              </div>
                                            </div>

                                            <div class="form-group">
                                              <label for="name" class="col-sm-2 control-label">Password</label>
                                              <div class="col-sm-10">
                                                <input type="password" class="form-control" id="password" placeholder="Your password" ng-model="loginUser.password"  > 
                                              </div>
                                            </div>
                                            
                                          </div>
                                          <div class="card-footer">
                                            <div align="center">
                                              <button type="submit" ng-click="login()" class="btn btn-success submit" ><span class="glyphicon glyphicon-edit"></span>
                                                Login
                                              </button>
                                              
                                            </div>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                              </div><!-- /.modal -->
                           </div>
                         </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
