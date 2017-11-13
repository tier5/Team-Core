<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use Session;

class LoginController extends Controller
{
    public function login()
    {
    	$data= Request::all();
    	$user=User::where('email', $data['email'])
    			  ->where('password' , $data['password'])
    			  ->get();

    	if(count($user)>0)
    	{
    		$get_user=$user->first();
    		Session::put('user_id', $get_user->id);
    		Session::put('user_name', $get_user->name);
    		return 1;
    	}
    	return 0;
    }

    public function logout()
    {
    	if(Session::has('user_id'))
    	{
    		Session::forget('user_id');
    		Session::forget('user_name');
    	}
    }
}
