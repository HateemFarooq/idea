<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class LocationController extends Controller
{
    public function index()
{
    $countries = Country::with('states.cities')->get();
    $user = auth()->user();

    return view('Pages.edit_location', compact('countries', 'user'));
}

public function update(Request $request)
{
    $request->validate([
        'country_id' => 'required|exists:countries,id',
        'state_id' => 'required|exists:states,id',
        'city_id' => 'required|exists:cities,id',
    ],
    [
        'country_id.required' => 'Please select a country.',
        'state_id.required' => 'Please select a state.',
        'city_id.required' => 'Please select a city.',
    ]);

    $user = auth()->user();

    $user->update([
        'country_id' => $request->country_id,
        'state_id' => $request->state_id,
        'city_id' => $request->city_id,
    ]);

    return redirect()->route('ideas')
        ->with('success', 'Location updated successfully.');
}
}
