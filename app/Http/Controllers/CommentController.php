<?php
namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (!$request->input('comments')) {
                return response()->json(['error' => 'Comment yoxdur.'], 400);
            }
           

            $comment = new Comments;
            $comment->comment = $request->input('comments');
            $comment->user_id = $user->id;
            $comment->save();

            return redirect()->back()->with('messege', 'Comment gonderildi!');
        } else {
            return redirect()->back()->with('error', 'İstifadəçi hesabı yoxdur!');
        }
    }
}
