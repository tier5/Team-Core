<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
class UserController extends Controller
{
    
    public function index($id =null)
    {
        if($id== null)
        {
            $users=User::orderBy('id','desc')->get();
            //dd($users);
            return $users;

        }
        else
        {
            return $this->show($id);
        }
    }

    public function store()
    {
        $data= Request::all();
        //dd($request);
        //echo $request->input('name');
        $user= User::create([
            'name' => $data['name'],
            'password' => $data['password'],
            'email' => $data['email']
            ]);
        //echo $user;
        return $user;
    }
    
    public function show($id)
    {
        $user=User::find($id);
        return $user;
    }

    public function destroy($id)
    {
        $user=User::find($id)->delete();
        return "User deleted successfully";
    }

    public function update($id)
    {
        $data= Request::all();
        
        $user=User::where('id', $id)
                ->update([ 
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $data['password']
                ]);
        return $data;
    }
    
}
