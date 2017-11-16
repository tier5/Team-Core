import {Component, Injectable , OnInit, ViewContainerRef} from '@angular/core';
import { UserService } from "../services/user.service";
import {Users} from '../models/users';
import {ToastsManager} from '../../../node_modules/ng2-toastr/ng2-toastr';
import {NgForm} from "@angular/forms";

@Injectable()

@Component({
  selector: 'app-user-list',
  templateUrl: './user-list.component.html'
})
export class UserListComponent implements OnInit {

    constructor(private userService: UserService , public toastr: ToastsManager ,vcr: ViewContainerRef) {
        this.toastr.setRootViewContainerRef(vcr);
        this.onGet();
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
                this.myResp = JSON.parse(JSON.stringify(data));
                this.users = this.myResp.response;
            },
            error => console.log(error)
        );
    }

}
