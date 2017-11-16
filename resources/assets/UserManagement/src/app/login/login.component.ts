import {Component, Injectable , OnInit, ViewContainerRef} from '@angular/core';
import {NgForm} from "@angular/forms";
import {ToastsManager} from '../../../node_modules/ng2-toastr/ng2-toastr';
import { UserService } from "../services/user.service";
import {Router} from '@angular/router';
import { Location } from '@angular/common';
@Injectable()

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
})
export class LoginComponent implements OnInit {

  constructor(private userService: UserService , public toastr: ToastsManager ,vcr: ViewContainerRef, private  location: Location, private router: Router) {
        this.toastr.setRootViewContainerRef(vcr);
        if(this.userService.authenticate())
        {
          this.location.back();
        }
    }
  myResp: any;
  formCheck : string;

  ngOnInit() {
  }

  loginUser(form: NgForm) {

        console.log(form.value);
        this.userService.doLogin(form.value).subscribe(
          data => {
              this.myResp = JSON.parse(JSON.stringify(data))
              if(this.myResp.status == true){
                  localStorage.setItem( 'id',this.myResp.response.id);
                  this.toastr.success('User logged in successfully', 'Success Alert', {timeOut: 2000});
                  this.formCheck='';
                  this.router.navigate(['users']);
              }
              else {
                console.log(form);
                this.formCheck = "The email and password doesn't match."
                // this.form.
              }

          },
          error => {
              this.toastr.error('User not logged in successfully', 'Error Alert', {timeOut: 2000});
              console.log(error)
          }
      );
  }

}
