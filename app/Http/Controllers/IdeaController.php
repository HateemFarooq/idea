<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Idea;

class IdeaController extends Controller
{
    public function index()
    {
        // Get only logged-in user's ideas (latest first)
        $ideas = Idea::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('Pages.ideas', compact('ideas'));
    }
}
