<div class="container" ng-controller="HomeController">
   <div class="row">
      <div class="col-md-8 col-md-offset-2">
         <div class="panel panel-default">
            <div class="panel-heading">Angular</div>
            <div class="panel-body">
               <div ng-show="showModal" tabindex="-1" role="dialog" id="showModal" >
                  <div class="modal-dialog" >
                     <div class="modal-content">
                        <div class="modal-header">
                           <div class="col-md-11">
                              <h1 class="modal-title"> New User</h1>
                           </div>
                           <div class="col-md-1">
                              <button type="button" class="close close_link" data-dismiss="modal" aria-hidden="true" ng-click="closeModal('showModal')">&times;</button><br>
                           </div>
                        </div>
                        <div class="modal-body">
                           <form class="form-horizontal" role="form" name="addForm" ng-submit="submitAddForm(addForm.$valid)" novalidate>
                              {{ csrf_field()}}
                              <div class="card mb-3">
                                 <div class="card-header"><i class="fa fa-table"> New User</i></div>
                                 <div class="card-body">
                                    <div class="form-group" ng-class="{ 'has-error' : addForm.name.$invalid && submitted}">
                                       <label  class="col-sm-2 control-label">Name</label>
                                       <div class="col-sm-10">
                                          <input type="text" class="form-control" id="name" placeholder="Your Name" ng-model="newUser.name" name="name" required>
                                          <p ng-show="addForm.name.$invalid && submitted" class="help-block">You name is required.</p>
                                       </div>
                                    </div>
                                    <div class="form-group" ng-class="{ 'has-error' : addForm.email.$invalid && !addForm.email.$pristine && submitted}">
                                       <label  class="col-sm-2 control-label">Email</label>
                                       <div class="col-sm-10">
                                          <input type="email" class="form-control" id="email" placeholder="Your Email" ng-model="newUser.email" name="email" required>
                                          <p ng-show="addForm.email.$invalid && !addForm.email.$pristine && submitted" class="help-block">You email is invalid.</p>
                                       </div>
                                    </div>
                                    <div class="form-group" ng-class="{ 'has-error' : addForm.password.$invalid && !addForm.password.$pristine  && submitted}">
                                       <label  class="col-sm-2 control-label">Password</label>
                                       <div class="col-sm-10">
                                          <input type="password" class="form-control" id="password" placeholder="Your Password" ng-model="newUser.password" name="password" ng-minlength="6" ng-maxlength="30" password-format-validator required/>
                                          
                                          <ng-messages for="addForm.password.$error" ng-show="addForm.password.$touched && submitted" multiple ng-class="has-error">
                                             <p ng-message="required" class="help-block">Password is required</p>
                                             <p ng-message-exp="['minlength', 'maxlength']" class="help-block">Password must be between 6 and 30 characters in length</p>
                                             <p ng-message="digit" class="help-block">Password must include a digit</p>
                                             <p ng-message="case" class="help-block">Password must include both upper and lower case characters</p>
                                             <p ng-message="special" class="help-block">Password must include a special character</p>
                                          </ng-messages>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="card-footer">
                                    <div align="center">
                                       <button type="submit" ng-click="" class="btn btn-success submit" ><span class="glyphicon glyphicon-add"></span>
                                       Add User
                                       </button>
                                       <button type="button" ng-click="closeModal('showModal')" class="btn">Cancel</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
               </div>
               <div ng-show="editModal" tabindex="-1" role="dialog" id="editModal">
                  <div class="modal-dialog" >
                     <div class="modal-content">
                        <div class="modal-header">
                           <div class="col-md-11">
                              <h1 class="modal-title"> Edit User</h1>
                           </div>
                           <div class="col-md-1">
                              <button type="button" class="close close_link" data-dismiss="modal" aria-hidden="true" ng-click="closeModal('editModal')">&times;</button><br>
                           </div>
                        </div>
                        <div class="modal-body">
                           <form class="form-horizontal" role="form" name="editForm" ng-submit="submitEditForm(editForm.$valid)" novalidate >
                              {{ csrf_field()}}
                              <div class="card mb-3">
                                 <div class="card-header"><i class="fa fa-table"> User</i></div>
                                 <div class="card-body">
                                    <div class="form-group" ng-class="{ 'has-error' : editForm.name.$invalid && editSubmitted}">
                                       <label class="col-sm-2 control-label" >Name</label>
                                       <div class="col-sm-10">
                                          <input type="text" class="form-control" id="name" placeholder="Your Name" ng-model="editUser.name" name="name" value="@{{editUser.name}}"  ng-pattern="/^[a-zA-Z0-9]{1,11}$/" required> 
                                          <p ng-show="editForm.name.$pristine" class="help-block">You name is required.</p>

                                          <p ng-show="editForm.name.$invalid  && editSubmitted" class="help-block">You name is invalid.</p>
                                       </div>
                                    </div>
                                    <div class="form-group" ng-class="{ 'has-error' : editForm.email.$invalid &&  editSubmitted}">
                                       <label " class="col-sm-2 control-label">Email</label>
                                       <div class="col-sm-10">
                                          <input type="text" class="form-control" id="email" placeholder="Your Email" ng-model="editUser.email" value="@{{editUser.email}}" disabled> 
                                          <p ng-show="editForm.email.$invalid && !editForm.email.$pristine && editSubmitted" class="help-block">You email is required.</p>
                                       </div>
                                    </div>
                                    <div class="form-group" ng-class="{ 'has-error' : editForm.password.$touched && editSubmitted}">
                                       <label  class="col-sm-2 control-label">Password</label>
                                       <div class="col-sm-10">
                                          <input type="password" class="form-control" id="password" placeholder="Your password" ng-model="editUser.password" value="@{{editUser.password}}" name="password" ng-minlength="6"
                 ng-maxlength="30" password-format-validator required> 
                                         
                                          <ng-messages for="editForm.password.$error" ng-show="editForm.password.$touched && editSubmitted" multiple ng-class="has-error">
                                             <p ng-message="required" class="help-block">Password is required</p>
                                             <p ng-message-exp="['minlength', 'maxlength']" class="help-block">Password must be between 6 and 30 characters in length</p>
                                             <p ng-message="digit" class="help-block">Password must include a digit</p>
                                             <p ng-message="case" class="help-block">Password must include both upper and lower case characters</p>
                                             <p ng-message="special" class="help-block">Password must include a special character</p>
                                          </ng-messages>
                                       </div>
                                       
                                    </div>
                                 </div>
                                 <div class="card-footer">
                                    <div align="center">
                                       <button type="submit" class="btn btn-success submit" ><span class="glyphicon glyphicon-edit"></span>
                                       Edit User
                                       </button>
                                       <button type="button" ng-click="closeModal('editModal')" class="btn">Cancel</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
               </div>
               <!-- /.modal -->
            </div>
            <div class="panel-body">
               <button class="btn btn-info" ng-click="openModal('showModal')"> Create New User</button>
               <div class="row">
                  <div class="col-md-12">
                     <table class="table table-hover" id="user-details" ng-init="getUsers()">
                        <thead>
                           <tr>
                              <th>Id</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th> Delete </th>
                              <th> Edt </th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr ng-repeat="user in users">
                              <td>@{{user.id}} </td>
                              <td>@{{user.name}} </td>
                              <td>@{{user.email}} </td>
                              <td> <button class="btn btn-danger" ng-click="confirmDelete(user.id)">Delete </button>
                              <td> <button ng-click="openEditModal('editModal', user)" class="btn btn-info">Edit</button> </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         
         <!-- /.modal -->
      </div>
   </div>
</div>