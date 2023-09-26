<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\CompanyAdd;
use App\Models\Post;
use Illuminate\Http\Request;

class AdvertController extends Controller
{
    public function index()
    {
        $adverts = Advert::all();
        $posts = Post::all();
        return view("home", compact("adverts" , "posts"));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|min:2|max:255",
            "user_id" => ["required", "exists:users,id"],
            "company_id" => ["required", "exists:company,id"],
        ]);

        $advert = new Advert();
        $advert->title = $request->title;
        $advert->user_id = $request->user_id;
        $advert->company_id = $request->company_id;
        $advert->save();

        return redirect()->route("home")->with("success", "Advert added successfully!");
    }

    public function create()
    {
        $adverts = Advert::all();
        return view("home", compact("adverts"));


    }
}