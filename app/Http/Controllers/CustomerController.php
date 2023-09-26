<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class CustomerController extends Controller
{
    //
    function addCustomer(Request $req)
    {
        $req->validate([
            "username"=>"required|min:3|max:20",
            "age"=>"required",
            "email"=>"required|min:5|max:50",
            "password"=>"required|min:8|max:30"
        ]);
        $customer = new User;
        $customer->username = $req->username;
        $customer->email = $req->email;
        $customer->age = $req->age;
        $customer->password = Hash::make($req->password);
        $customer->save();

        return redirect()->route("login");

        
    }

    function login(Request $req)
    {
        $req->validate([
            "email" => "required|email",
            "password" => "required|min:8|max:30"
        ]);
    
        $credentials = $req->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->with('error', 'Email vəya şifrə yanlışdır!');
        }
    }
    function logout(Request $req)
    {
        Auth::logout(); 
        return redirect('/login');
    }
}