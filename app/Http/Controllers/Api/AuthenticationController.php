<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthenticationController extends Controller
{
    public function authenticate($token){
        if(!$tokenable = DB::table('personal_access_tokens')->where('token', $token)->first()){
            return response()->json([
                'error' => 'User not Logged In.',
                'status' => 0
            ]);
        } else {
            $user = User::where('id', $tokenable->tokenable_id)->first();
            return redirect('login/'.$token);
        }
    }

    public function create_token(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
      
        $user = User::where('email', $request->input('email'))->first();
  
        if (! $user || ! Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'error' => 'The provided credentials are incorrect.',
                'status' => 0
            ]);
        }
 
        $user->tokens()->delete();

        $token = $user->createToken($request->input('device_name'))->plainTextToken;

        $token = DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->first()->token;
 
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'msg' => 'Login Successfully',
            'status' => 1,
            'data' => [
                'user_name' => $user->name,
                'user_email' => $user->email
            ]
        ]);
    }
}
