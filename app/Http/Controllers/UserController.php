<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],  
            'email' => ['required', 'string', 'email', 'max:255','unique:users'],                  
            'password' => ['required', 'string','min:3']
        ]);
        if ($validator->fails()) {         
            return response()->json(['errorStr' => 'VALIDATION_FAILED','errors' => $validator->errors()], 400);                 
        }
        $user=User::create([
            'name' => $request->name,           
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json(['errorStr'=>'','data'=>$user->toArray()], 200); 
        
    }
    public function getUser()
    {
        
        $user = Auth::user(); 
        if($user)
        {
            return response()->json(['errorStr'=>'','user'=>$user->toArray()], 200); 
        }
        else
        {
            return response()->json(['errorStr'=>'Unauthorised','message'=>"user empty"], 401); 
        }
        
    }
}
