<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminStepsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $steps = Step::with('idea.user')
            ->when($search, function ($query) use ($search) {

                $query->where('description', 'LIKE', "%{$search}%")
                    ->orWhereHas('idea', function ($q) use ($search) {
                        $q->where('title', 'LIKE', "%{$search}%");
                    });

            })
            ->paginate(5)
            ->withQueryString();

        return Inertia::render('Steps', [
            'steps' => $steps,
            'filters' => $request->only('search'),
        ]);
    }
}
