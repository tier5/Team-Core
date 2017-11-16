import {Component, Injectable , OnInit, ViewContainerRef} from '@angular/core';
import { UserService } from "../services/user.service";
import {Users} from '../models/users';
import {ToastsManager} from '../../../node_modules/ng2-toastr/ng2-toastr';
import {NgForm} from "@angular/forms";
import {Router} from '@angular/router';

@Component({
  selector: 'app-add-user',
  templateUrl: './add-user.component.html',
})
export class AddUserComponent implements OnInit {

  getAdd :boolean;
  myResp: any;
  users : Users;
  check : boolean;
  addValue : Users;
  constructor(private userService: UserService , public toastr: ToastsManager ,vcr: ViewContainerRef , private router: Router) {
        this.toastr.setRootViewContainerRef(vcr);
        this.userService.authenticate();
        this.getAdd = true;
  }

  ngOnInit() {
  }

  onGetAdd() {
      this.getAdd = true;
  }

  onAdd(form: NgForm) {
        this.addValue =form.value;
        console.log(form.value);
        console.log(this.addValue);
        this.userService.addUser(this.addValue).subscribe(
            data => {
                this.myResp = JSON.parse(JSON.stringify(data));
                if(this.myResp.status=== true) {
                    this.toastr.success('User added successfully', 'Success Alert', {timeOut: 4000});
                    this.router.navigate(['/users']);

                }
                else{
                    this.toastr.error('User not updated successfully', 'Error Alert', {timeOut: 4000});
                }

            },
            error => console.log(error)
        );
  }
}
