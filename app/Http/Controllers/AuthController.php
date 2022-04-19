<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required',
            'role' => 'required']);

        if($validator->fails()){
            $response = [
                'data' => null,
                'access_token' =>null,
                'token_type' =>'Bearer',
                'status' => 0
            ];
    
            return response()->json($response,Response::HTTP_CREATED);
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
            'password' => Hash::make($request->password)
         ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = [
            'data' => $user,
            'access_token' =>$token,
            'token_type' =>'Bearer',
            'status' => 1
        ];

        return response()->json($response,Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('username', 'password')))
        {
            $response = [
                'data' => null,
                'access_token' =>null,
                'token_type' =>'Bearer',
                'status' => 0
            ];
    
            return response()->json($response,Response::HTTP_CREATED);
    
        }

        $updatetoken = DB::table('users')->where('username',$request->username)->update(['token_id' => $request->token_id]);
        $user = User::where('username', $request['username'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        if ($user->role ==0) {
            $response = [
                'data' => $user,
                'access_token' =>$token,
                'token_type' =>'Bearer',
                'status' => 1
            ];
    
        }else{
            $response = [
                'data' => $user,
                'access_token' =>$token,
                'token_type' =>'Bearer',
                'status' => 2
            ];
    
        }

        return response()->json($response,Response::HTTP_CREATED);

    }

    public function getusers(Request $request)
    {
        $getdata = User::where('role',$request->input('role'))->get();
        $response = [
            'data' => $getdata,
            'message' => 'getdata'
        ];
        return response()->json($response,Response::HTTP_CREATED);
    }


}