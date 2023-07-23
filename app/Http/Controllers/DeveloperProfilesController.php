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
        $developerProfile = DeveloperProfile::where('user_id', $id)->first();

        // Check if the developer profile exists
        if (!$developerProfile) {
            return redirect()->route('developers')->with('error', 'Developer profile not found.');
        }

        // If everything is valid, return the view with the developer profile data
        return view('developer-profile', compact('developerProfile'));
    }
}
