<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
// use Illuminate\Foundation\Auth\User;
use App\Models\User;

class UserController extends Controller
{
    //Show Register/create Form

    public function create(){
        return view('users.register');
    }


    //Create New user
    public function store(Request $request){
        $formFields = $request->validate([
           'name' => ['required','min:3'],
           'email'=> ['required','email', Rule::unique('users','email')],
           'password'=>'required|confirmed|min:6'
        ]);
        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create User
        $user = User::create($formFields);
        

        //Login
        auth()->login($user);

        return redirect('/')->with('message','User created and logged in');
    }
}
