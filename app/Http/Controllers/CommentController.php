<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
        {
            return view('client.show');
        }
    public function comments()
        {
            $viewData = [];
            $viewData["title"] = "My Comment - The Restaurant";
            $viewData["subtitle"] = "My Comment";
            $viewData["comments"] = Comment::where('user_id', Auth::user()->id)->get();
            return view('client.show')->with("viewData", $viewData);
        }

    
    
    public function store(Request $request, $foodId)
    {
        $request->validate(['content' => 'required|string|max:500',]);

        $comment = new Comment();
        $comment->food_id = $foodId;
        $comment->user_id = Auth::id();
        $comment->content = $request->content;
        $comment->save();
        return back()->with('success', 'Comment added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['content' => 'required|string|max:500',]);

        $comment = Comment::findOrFail($id);

        if ($comment->user_id != Auth::id()) { abort(403); }

        $comment->content = $request->content;
        $comment->save();

        return back();
    }
    
}
