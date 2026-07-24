<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Country;
use App\Models\State;


class StatesController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search', '');

    $states = State::with('country')
    ->where(function($query) use ($search) {
        $query->whereHas('country', function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
        })
        ->orWhere('name', 'like', "%{$search}%");
    })
    ->orderBy('id', 'desc')
    ->paginate(5)
    ->withQueryString();

    return inertia('states', [
        'states' => $states,
        'filters' => [
            'search' => $search
        ]
    ]);
}
    public function create()
    {
        return inertia('create_states', [
            'countries' => Country::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
    'name' => 'required|string|max:255',
    'country_id' => 'required|exists:countries,id',
],
[
    'name.required' => 'State name is required.',
    'country_id.required' => 'Country selection is required.',
]
);

        State::create([
        'name' => $request->name,
        'country_id' => $request->country_id
    ]);

        return redirect()->route('admin.states')->with('success', 'State added successfully!');
    }
    public function edit(State $state)
{
    return inertia('edit_states', [
        'state' => $state->load('country'),
        'countries' => Country::all()
    ]);
}

public function update(Request $request, State $state)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'country_id' => 'required|exists:countries,id',
    ],
    [
        'name.required' => 'State name is required.',
        'country_id.required' => 'Country selection is required.',
    ]
);

    $state->update([
        'name' => $request->name,
        'country_id' => $request->country_id
    ]);

    return redirect()->route('admin.states')
        ->with('success', 'State updated successfully!');
}
public function destroy(State $state)
{
    $state->delete();

    return redirect()->back()
        ->with('success', 'State deleted successfully!');
}
}
