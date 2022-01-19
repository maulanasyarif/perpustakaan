<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        $rules = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        if(!$rules)
        {
            return response()->json([
                'status'=> 422,
                'validationErrors'=> $validator->messages(),
            ]);
        }

        $email      = $request->email;
        $password   = $request->password;
        
        $admin = Admin::where('email', $email)->first();

        if(!$admin)
        {
            $user = User::where('email', $email)->first();

            if(!$user)
            {
                return response()->json([
                    'status'    => 404,
                    'message'   => 'Email not found',
                ]);
            } else {
                $loginUser = Auth::guard('user')->attempt(['email' => $email, 'password' => $password]);

                if(!$loginUser)
                {
                    return response()->json([
                        'status'    => 401,
                        'message'   => 'Login failed',
                    ]);
                    
                } else {
                    return response()->json([
                        'status'    => 200,
                        'message'   => 'Login successfully',
                    ]);
                }
            }
        }   
        
        $loginAdmin = Auth::guard('admin')->attempt(['email' => $email, 'password' => $password]);

        if(!$loginAdmin)
        {
            return response()->json([
                'status'    => 401,
                'message'   => 'Login failed',
            ]);
            
        } else {
            return response()->json([
                'status'    => 200,
                'message'   => 'Login successfully',
            ]);
        }
        
    }

    public function register(Request $request)
    {
        $rules = $request->validate([
            'name'          => 'required',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|min:8',
            'phone_number'  => 'required|max:12',
        ]);

        if(!$rules)
        {
            return response()->json([
                'status'=> 422,
                'message'=> 'All field has required!!!',
            ]);
        } else {

            $user = new User;
            $user->name             = $request->name;
            $user->phone_number     = $request->phone_number;
            $user->email            = $request->email;
            $user->password         = Hash::make($request->password);
            $user->save();
    
            return response()->json([
                'status'    => 200,
                'message'   => 'Register successfully',
            ]);
            
        }
    }
}