<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\CompanyAdd;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{ 
    public function index()
    {
        $adverts = Advert::all();
        $posts = Post::all();
        $company = CompanyAdd::all();
        return view("home", compact("posts" , "adverts" , "company"));
    }

    public function store(Request $request)
    {
        if (Auth::check()) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $imageName);
                $user = Auth::user();
                $post = new Post;
                $post->image = $imageName;
                $post->description = $request->description;
                $post->user_id = $user->id;
                $post->save();


                return redirect()->back()->with('success', 'Post əlavə olundu !');
            }

            return redirect()->back()->with('error', 'Şəkil yoxdur!');

        } else {
            return redirect()->back()->with('error', 'İstifadəçi hesabı yoxdur!');
        }


    }

    public function edit(Post $post)
    {
        return view("edit", compact("post"));
    }


    public function update(Request $request, Post $post)
    {
        if (Auth::check()) {
            $request->validate([
                "description" => "required|min:4|max:255"
            ]);
            
            $post->description = $request->description;
            $post->save();

            return redirect()->back()->with('success', 'Postda düzəliş edildi');

        } else {
            return redirect()->back()->with('error', 'İstifadəçi hesabı yoxdur!');

        }

    }


    public function destroy(Post $post)
    {
        if (Auth::check()) {
            $post->delete();
            return redirect()->back()->with('success', 'Post silindi');
        } else {
            return redirect()->back()->with('error', 'İstifadəçi hesabı yoxdur!');

        }
    }





}