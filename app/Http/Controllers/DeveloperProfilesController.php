<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HandlesImageUploadToS3;
use App\Http\Requests\StoreDeveloperProfileRequest;
use App\Http\Requests\UpdateDeveloperProfileRequest;
use App\Jobs\CreateDeveloperProfileJob;
use App\Jobs\UpdateDeveloperProfileJob;
use App\Models\DeveloperProfile;

class DeveloperProfilesController extends Controller
{
    use HandlesImageUploadToS3;

    public function index()
    {
        if (DeveloperProfile::where('user_id', auth()->id())->exists()) {
            return redirect()->route('developerProfile', auth()->user()->developerProfile->id)->with('warning', 'You have already created a developer profile.');
        }

        return view('new-developer');
    }

    public function edit($id)
    {
        if (auth()->user()->developerProfile->id != $id) {
            return redirect()->route('developers')->with('error', 'You are not authorized to edit this profile.');
        }

        $developerProfile = DeveloperProfile::where('id', $id)->first();

        if (! $developerProfile) {
            return redirect()->route('developers')->with('error', 'Developer profile not found.');
        }

        return view('edit-developer', ['developerProfile' => $developerProfile]);
    }

    public function store(StoreDeveloperProfileRequest $storeDeveloperProfileRequest)
    {
        $data = $storeDeveloperProfileRequest->validated();

        if (DeveloperProfile::where('user_id', auth()->id())->exists()) {
            return response()->json([
                'message' => 'Developer profile already exists',
            ], 400);
        }

        $data = $this->handleTheImageUploadToS3($storeDeveloperProfileRequest, $data, 'profile_image_');

        dispatch(new CreateDeveloperProfileJob($data));

        return redirect()->route('developerProfile', auth()->user()->developerProfile->id)->with('success', 'Developer profile created successfully.');
    }

    public function show($id)
    {
        $developerProfile = DeveloperProfile::where('id', $id)->first();

        if (! $developerProfile) {
            return redirect()->route('developers')->with('error', 'Developer profile not found.');
        }

        return view('developer-profile', ['developerProfile' => $developerProfile]);
    }

    public function update(UpdateDeveloperProfileRequest $updateDeveloperProfileRequest, $id)
    {
        if (auth()->id() != $id) {
            return redirect()->route('developers')->with('error', 'You are not authorized to update this profile.');
        }

        $developerProfile = DeveloperProfile::where('user_id', $id)->first();

        if (! $developerProfile) {
            return redirect()->route('developers')->with('error', 'Developer profile not found.');
        }

        $data = $updateDeveloperProfileRequest->validated();

        $data = $this->handleTheImageUploadToS3($updateDeveloperProfileRequest, $data, 'profile_image_');

        dispatch(new UpdateDeveloperProfileJob($id, $data));

        return redirect()->route('developerProfile', $developerProfile->id)->with('success', 'Developer profile updated successfully.');
    }
}
