<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\IdeaStatus;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $filter = $request->get('status', 'all');

        // ✅ allowed filters
        $allowed = ['all', 'pending', 'in progress', 'completed'];

        // 🚨 reject invalid status
        if (! in_array($filter, $allowed, true)) {
            return redirect()->route('ideas'); // fallback to all
        }

        $query = Idea::where('user_id', $userId);

        if ($filter !== 'all') {
            $query->where('status', $filter);
        }

        $ideas = $query->latest()->get();

        $counts = [
            'all' => Idea::where('user_id', $userId)->count(),
            'pending' => Idea::where('user_id', $userId)->where('status', IdeaStatus::Pending)->count(),
            'in progress' => Idea::where('user_id', $userId)->where('status', IdeaStatus::InProgress)->count(),
            'completed' => Idea::where('user_id', $userId)->where('status', IdeaStatus::Completed)->count(),
        ];

        return view('Pages.ideas', ['ideas' => $ideas, 'filter' => $filter, 'counts' => $counts]);
    }
    public function show(Idea $idea)
{
    // security: user can only view own idea
    abort_if($idea->user_id !== Auth::id(), 403);

    return view('Pages.ideas_show', compact('idea'));
}

public function destroy(Idea $idea)
{
    abort_if($idea->user_id !== Auth::id(), 403);

    $idea->delete();

    return redirect()
        ->route('ideas')
        ->with('success', 'Idea deleted successfully.');
}
}

// <!-- <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use App\Models\Idea;

// class IdeaController extends Controller
// {
//     public function index()
//     {
//         // Get only logged-in user's ideas (latest first)
//         $ideas = Idea::where('user_id', Auth::id())
//             ->latest()
//             ->get();

//         return view('Pages.ideas', compact('ideas'));
//     }
// } -->
