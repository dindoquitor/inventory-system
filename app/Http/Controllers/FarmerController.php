<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FarmerController extends Controller
{
    public function index()
    {
        $farmers = Farmer::with('user')->latest()->get();
        return view('farmers.index', compact('farmers'));
    }

    public function create()
    {
        return view('farmers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sex' => 'required|in:Male,Female',
            'age' => 'required|integer|min:15|max:100',
            'hectares' => 'required|numeric|min:0.01|max:999.99',
            'address' => 'required|string|max:255',
            'farm_location' => 'required|string|max:255',
        ]);

        Farmer::create([
            'name' => $request->name,
            'sex' => $request->sex,
            'age' => $request->age,
            'hectares' => $request->hectares,
            'address' => $request->address,
            'farm_location' => $request->farm_location,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('farmers.index')->with('success', 'Farmer added successfully.');
    }

    public function edit(Farmer $farmer)
    {
        return view('farmers.edit', compact('farmer'));
    }

    public function update(Request $request, Farmer $farmer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sex' => 'required|in:Male,Female',
            'age' => 'required|integer|min:15|max:100',
            'hectares' => 'required|numeric|min:0.01|max:999.99',
            'address' => 'required|string|max:255',
            'farm_location' => 'required|string|max:255',
        ]);

        $farmer->update($request->only([
            'name',
            'sex',
            'age',
            'hectares',
            'address',
            'farm_location',
        ]));

        return redirect()->route('farmers.index')->with('success', 'Farmer updated successfully.');
    }

    public function destroy(Farmer $farmer)
    {
        $farmer->delete();

        return redirect()->route('farmers.index')->with('success', 'Farmer deleted successfully.');
    }
}
