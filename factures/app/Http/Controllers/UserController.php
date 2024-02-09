<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function GetUser()
    {
        $users = User::all();
        return response()->json(["data"=>$users],200);
    }

    public function store(UserRequest $request)
    {
        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'role' => $request->role,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(["message"=>"User Created"],201);
    }

    public function finById($id)
    {
        $user=User::find($id);
        if($user){
            return response()->json(["data"=>$user],200);
        }else{
            return response()->json(["message"=>"user Not Found"],404);
        }
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);
        if($user){

            $user->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'role' => $request->role,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            return response()->json(["message"=>"user Updated"],200);

        }else{
            return response()->json(["message"=>"user Not Found"],404);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if($user){
            $user->delete();
            return response()->json(["message"=>"Delete With Success"],200);
        }else{
            return response()->json(["message"=>"user Not Found"],404);
        }
    }

    public function countUsers()
    {
        $count = User::count();
        return response()->json(['count' => $count]);
    }
}
