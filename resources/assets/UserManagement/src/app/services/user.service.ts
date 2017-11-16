import {Injectable} from "@angular/core";
import { Headers } from '@angular/http';
import {Router} from '@angular/router';
import {HttpClient} from '@angular/common/http';


@Injectable()
export class UserService {

    constructor( private httpClient: HttpClient, private router: Router) {
    }

    getUsers() {
        return this.httpClient.get('http://127.0.0.1:8001/api/users');
    }

    editUser(edit: any) {

        return this.httpClient.post('http://127.0.0.1:8001/api/edit-user', edit);
    }

    addUser(add: any) {

        return this.httpClient.post('http://127.0.0.1:8001/api/add-user', add);
    }

    deleteUser(id:number) {
        console.log(id);
        return this.httpClient.get('http://127.0.0.1:8001/api/delete-user/'+id);
    }

    doLogin(user:any) {
        return this.httpClient.post('http://127.0.0.1:8001/api/login', user);
    }

    authenticate() {
        if(localStorage.getItem('id'))
        {
            return true;
        }
        else {

        }
        this.router.navigate(['login']);
    }

    doLogout() {
        localStorage.removeItem('id');
        this.router.navigate(['login']);
    }
}
