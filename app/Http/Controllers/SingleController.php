<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SingleController extends Controller
{
    public function index(Post $post)
    {
        $comments = $post->comments()->latest()->paginate(15);
        return view('single', compact('post', 'comments'));
    }

    public function comment(Request $request, Post $post)
    {
        $post->comments()->create([
            'user_id' => Auth::user()->id,
            'text' => $request->input('text'),
        ]);
        return redirect()->route('single', $post->id);
    }
}
