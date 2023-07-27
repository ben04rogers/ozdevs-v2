<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDevProfileRequest;
use App\Models\DeveloperProfile;
use Illuminate\Support\Facades\Log;

class DeveloperProfilesController extends Controller
{
    public function index() {
        if (DeveloperProfile::where('user_id', auth()->id())->exists()) {
            return redirect()->route('developers')->with('warning', 'You have already created a developer profile.');
        }

        return view("new-developer");
    }

    public function edit($id)
    {
        // Users can only edit their own profile
        if (auth()->user()->developerProfile->id != $id) {
            return redirect()->route('developers')->with('error', 'You are not authorized to edit this profile.');
        }

        // Find the developer profile by ID
        $developerProfile = DeveloperProfile::where('id', $id)->first();

        // Check if the developer profile exists
        if (!$developerProfile) {
            return redirect()->route('developers')->with('error', 'Developer profile not found.');
        }

        // Return the view with the developer profile data for editing
        return view('edit-developer', compact('developerProfile'));
    }

    public function store(StoreDevProfileRequest $request)
    {
        // Validate the request data
        $data = $request->validated();

        if (DeveloperProfile::where('user_id', auth()->id())->exists()) {
            return response()->json([
                'message' => 'Developer profile already exists',
            ], 400);
        }

        // Create a new developer profile with the validated data
        $developerProfile = new DeveloperProfile($data);

        // Set the user ID for the developer profile
        $developerProfile->user_id = auth()->id();

        // Save the developer profile
        $developerProfile->save();

        return redirect()->route('developers')->with('success', 'Developer profile created successfully.');
    }

    public function show($id)
    {
        // Find the developer profile by ID
        $developerProfile = DeveloperProfile::where('id', $id)->first();

        // Check if the developer profile exists
        if (!$developerProfile) {
            return redirect()->route('developers')->with('error', 'Developer profile not found.');
        }

        // If everything is valid, return the view with the developer profile data
        return view('developer-profile', compact('developerProfile'));
    }

    public function update(StoreDevProfileRequest $request, $id)
    {
        // Find the developer profile by ID
        $developerProfile = DeveloperProfile::where('user_id', $id)->first();

        // Check if the developer profile exists
        if (!$developerProfile) {
            return redirect()->route('developers')->with('error', 'Developer profile not found.');
        }

        // Validate the request data
        $data = $request->validated();

        // Update the developer profile with the validated data
        $developerProfile->update($data);

        return redirect()->route('developers')->with('success', 'Developer profile updated successfully.');
    }
}
