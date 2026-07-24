<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\State;
use App\Models\City;

class CitiesController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search', '');

    $cities = City::with('state')
        ->whereHas('state', function($query) use ($search) {
            $query->where('name', 'like', "%{$search}%");
        })
        ->orWhere('name', 'like', "%{$search}%")
        ->orderBy('id', 'desc')
        ->paginate(5)
        ->withQueryString();

    return inertia('cities', [
        'cities' => $cities,
        'filters' => [
            'search' => $search
        ]
    ]);
}
    public function create()
    {
        return inertia('create_cities', [
            'states' => State::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'required|exists:states,id',
        ],
        [
            'name.required' => 'City name is required.',
            'state_id.required' => 'Please select a state.',
        ]);

        City::create([
            'name' => $request->name,
            'state_id' => $request->state_id
        ]);

        return redirect()->route('admin.cities')
            ->with('success', 'City added successfully!');
    }

    public function edit(City $city)
    {
        return inertia('edit_cities', [
            'city' => $city,
            'states' => State::all()
        ]);
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'required|exists:states,id',
        ],
        [
            'name.required' => 'City name is required.',
            'state_id.required' => 'Please select a state.',
        ]);

        $city->update([
            'name' => $request->name,
            'state_id' => $request->state_id
        ]);

        return redirect()->route('admin.cities')
            ->with('success', 'City updated successfully!');
    }

    public function destroy(City $city)
    {
        $city->delete();

        return redirect()->back()
            ->with('success', 'City deleted successfully!');
    }
}
