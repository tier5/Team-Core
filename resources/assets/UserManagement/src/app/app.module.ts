import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from "@angular/router";
import { FormsModule } from "@angular/forms";
import { HttpModule } from "@angular/http";
import { NgClass } from '@angular/common';
import { UserService } from "./services/user.service";
import {HttpClientModule} from '@angular/common/http';
import {ToastModule} from '../../node_modules/ng2-toastr/ng2-toastr';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';

import { AppComponent } from './app.component';
import { HeaderComponent } from './header/header.component';
import { LoginComponent } from './login/login.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { AddUserComponent } from './add-user/add-user.component';
import { UserListComponent } from './user-list/user-list.component';



const appRoutes: Routes = [
    {
        path: 'dashboard',
        component: DashboardComponent
    },
    {
        path: 'login',
        component: LoginComponent
    },
    {
        path: 'users',
        component: UserListComponent
    },
    {
        path: 'add-user',
        component: AddUserComponent
    },
]

@NgModule({
    declarations: [
        AppComponent,
        HeaderComponent,
        LoginComponent,
        DashboardComponent,
        AddUserComponent,
        UserListComponent
    ],
    imports: [
        RouterModule.forRoot(appRoutes),
        BrowserAnimationsModule,
        ToastModule.forRoot(),
        BrowserModule,
        FormsModule,
        HttpModule,
        HttpClientModule,

    ],
    providers: [UserService],
    bootstrap: [AppComponent]
})
export class AppModule {

}
