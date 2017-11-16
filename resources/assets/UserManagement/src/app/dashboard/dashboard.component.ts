import {Component, Injectable , OnInit, ViewContainerRef} from '@angular/core';
import { UserService } from "../services/user.service";
import {Users} from '../models/users';
import {ToastsManager} from '../../../node_modules/ng2-toastr/ng2-toastr';
import {NgForm} from "@angular/forms";

@Injectable()

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
})
export class DashboardComponent implements OnInit {
  constructor(private userService: UserService , public toastr: ToastsManager ,vcr: ViewContainerRef) {
      this.toastr.setRootViewContainerRef(vcr);
      this.userService.authenticate();
  }
  myResp: any;
  users : Users;
  check : boolean;
  getEdit : Users;
  editValue : Users;

  ngOnInit() {
  }

  onGet() {
        this.userService.getUsers().subscribe(
            data => {
            this.userService.authenticate();
            this.myResp = JSON.parse(JSON.stringify(data));
            this.toastr.success('Users loaded successfully', 'Success Alert', {timeOut: 2000});
            this.users = this.myResp.response;
            console.log(this.users);
            },
            error => console.log(error)
        );
  }
  onEdit(form: NgForm) {
      this.editValue =form.value;

      this.userService.editUser(this.editValue).subscribe(
          data => {
              this.myResp = JSON.parse(JSON.stringify(data));
              if(this.myResp.status=== true) {
                  this.toastr.success('User updated successfully', 'Success Alert', {timeOut: 2000});
                  this.onGet();
                  this.getEdit=null;
                  console.log(this.getEdit);
              }
              else{
                  this.toastr.error('User not updated successfully', 'Error Alert', {timeOut: 2000});
              }

          },
          error => console.log(error)
      );
  }

  onGetEdit(id:Users) {

      this.getEdit = id;
  }

  onDelete(id:number) {
      this.check  = confirm('Are you sure you want to delete ?');
      console.log(this.check);
      console.log(id);
      if(this.check){
          this.userService.deleteUser(id).subscribe(
              data => {
                  this.myResp = JSON.parse(JSON.stringify(data))
                  if(this.myResp.status == true){
                      this.toastr.error('User deleted successfully', 'Success Alert', {timeOut: 5000});
                      this.onGet();
                  }
                  console.log(this.myResp.status);
              },
              error => {
                  this.toastr.error('User not deleted successfully', 'Success Alert', {timeOut: 5000});
                  console.log(error)
              }
          );
      }
  }

}
