<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Country;

class CountriesController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search', '');

    $countries = Country::where('name', 'like', "%{$search}%")
        ->orderBy('id', 'desc')
        ->paginate(5) // Change 5 to how many per page you want
        ->withQueryString(); // Keep search query when paginating

    return inertia('countries', [
        'countries' => $countries,
        'filters' => [
            'search' => $search
        ]
    ]);
}
    public function create()
    {
        return inertia('create_country');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ],        [
            'name.required' => 'The country name is required.',
        ]
        );

        Country::create([
        'name' => $request->name
    ]);

        return redirect()->route('admin.countries')->with('success', 'Country added successfully!');
    }
    public function edit(Country $country)
{
    return inertia('edit_country', [
        'country' => $country
    ]);
}

public function update(Request $request, Country $country)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ],
    [
        'name.required' => 'The country name is required.',
    ]
    );

    $country->update([
        'name' => $request->name
    ]);

    return redirect()->route('admin.countries')
        ->with('success', 'Country updated successfully!');
}

public function destroy(Country $country)
{
    $country->delete();

    return redirect()->back()
        ->with('success', 'Country deleted successfully!');
}
}
