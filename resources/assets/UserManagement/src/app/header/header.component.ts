import {Component, Injectable , OnInit, ViewContainerRef} from '@angular/core';
import {NgForm} from "@angular/forms";
import {ToastsManager} from '../../../node_modules/ng2-toastr/ng2-toastr';
import { UserService } from "../services/user.service";

@Injectable()
@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
})
export class HeaderComponent implements OnInit {

  loginCheck: boolean;
    constructor(private userService: UserService , public toastr: ToastsManager ,vcr: ViewContainerRef) {
        this.toastr.setRootViewContainerRef(vcr);
        this.loginCheck= this.userService.authenticate();
    }
    myResp: any;

    ngOnInit() {
    }

    logout() {
      this.userService.doLogout();
    }

}
