<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create(Request $request){
        $validatorUser = Validator::make($request->all(),[
            'name' => 'required',
            'email' => ['required',Rule::unique('users','email')],
            'password' => ['required','confirmed','min:6']
        ]);
        if($validatorUser->fails()){
            return response()->json([
                'status' =>false,
                'message' => 'validation errors',
                'errors' => $validatorUser->errors()
            ],401);
        }
        $user = User::create($validatorUser->validated());
        auth()->login($user);
        return $user;
    }

    public function login(Request $request){
        $validatorUser = Validator::make($request->all(),[
            'email' => ['required',Rule::exists('users','email')],
            'password' => ['required','min:6']
        ]);
        if($validatorUser->fails()){
            return response()->json([
                'status' =>false,
                'message' => 'validation errors',
                'errors' => $validatorUser->errors()
            ],401);
        }
        if (Auth::attempt($validatorUser->validated())) {
            $request->session()->regenerate();
            return auth()->user();
        }
    }

    public function logout(){
        auth()->logout();
    }
}
