<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminIdeaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $ideas = Idea::with(['user', 'steps'])
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            })
            ->paginate(5)
            ->withQueryString();

        return Inertia::render('Ideas', [
            'ideas' => $ideas,
            'filters' => $request->only('search'),
        ]);
    }

    public function destroy(Idea $idea)
    {
        $idea->delete();

        return redirect()->back()->with('success', 'Idea deleted successfully');
    }
}
