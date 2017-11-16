<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
class UserController extends Controller
{
    public function index()
    {
        $users= User::orderBy('id','desc')->get();
        //dd($users);
        // return response()->json($users);
        return response()->json([
            'status' =>true,
            'response' => $users
        ], 200);
    }

    /*to add a user */
    public function add(Request $request)
    {
        $user= User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => $request['password']
              ]);
        if($user)
        {
            return response()->json([
                'status' =>true
            ], 200);
        }
        return response()->json([
            'status' =>false
        ], 200);

    }


    /*to delete a user */
    public function delete($id)
    {
        $user = User::find($id)->delete();
        if($user)
        {
            return response()->json([
                'status' =>true
            ], 200);
        }
        return response()->json([
            'status' =>false
        ], 200);
    }

    /*to edit a user */
    public function edit(Request $request)
    {

        $user= User::find($request['id'])
                    ->update([
                        'name' => $request['name'],
                        'email' => $request['email']
                    ]);
        if($user)
        {
            return response()->json([
                'status' =>true
            ], 200);
        }
        return response()->json([
            'status' =>false
        ], 200);

    }

    /*to do the login */
    public function login(Request $request)
    {
        $user= User::where('email',$request['name'])
                    ->where('password', $request['password']);
        if($user->exists())
        {
            return response()->json([
                'status' =>true,
                'response' => $user->get()->first()
            ], 200);
        }
        return response()->json([
            'status' =>false,
            'response' => $user->get()->first()
        ], 200);
    }

    public function editget()
    {
        $user= User::where('id', 6)->get()->first();
        return view('edit', compact('user'));

    }
}
