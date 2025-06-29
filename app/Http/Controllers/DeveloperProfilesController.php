<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDevProfileRequest;
use App\Models\DeveloperProfile;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DeveloperProfilesController extends Controller
{
    public function index() {
        if (DeveloperProfile::where('user_id', auth()->id())->exists()) {
            return redirect()->route('developerProfile', auth()->user()->developerProfile->id)->with('warning', 'You have already created a developer profile.');
        }

        return view("new-developer");
    }

    public function edit($id)
    {
        if (auth()->user()->developerProfile->id != $id) {
            return redirect()->route('developers')->with('error', 'You are not authorized to edit this profile.');
        }

        $developerProfile = DeveloperProfile::where('id', $id)->first();

        if (!$developerProfile) {
            return redirect()->route('developers')->with('error', 'Developer profile not found.');
        }

        return view('edit-developer', ['developerProfile' => $developerProfile]);
    }

    public function store(StoreDevProfileRequest $request)
    {
        $data = $request->validated();

        if (DeveloperProfile::where('user_id', auth()->id())->exists()) {
            return response()->json([
                'message' => 'Developer profile already exists',
            ], 400);
        }

        $data = $this->handleTheImageUploadToS3($request, $data);

        $name = $data['name'] ?? null;
        unset($data['name']);

        $developerProfile = new DeveloperProfile($data);

        $developerProfile->user_id = auth()->id();

        $developerProfile->save();

        if ($name) {
            $user = User::find(auth()->id());
            if ($user) {
                $user->update([
                    'name' => $name,
                ]);
            }
        }

        return redirect()->route('developerProfile', auth()->user()->developerProfile->id)->with('success', 'Developer profile created successfully.');
    }

    public function show($id)
    {
        $developerProfile = DeveloperProfile::where('id', $id)->first();

        if (!$developerProfile) {
            return redirect()->route('developers')->with('error', 'Developer profile not found.');
        }

        return view('developer-profile', ['developerProfile' => $developerProfile]);
    }

    public function update(StoreDevProfileRequest $request, $id)
    {
        $developerProfile = DeveloperProfile::where('user_id', $id)->first();

        if (!$developerProfile) {
            return redirect()->route('developers')->with('error', 'Developer profile not found.');
        }

        $data = $request->validated();

        $data = $this->handleTheImageUploadToS3($request, $data);

        $name = $data['name'] ?? null;
        unset($data['name']);

        $developerProfile->update($data);

        if ($name) {
            $user = User::find($id);
            if ($user) {
                $user->update([
                    'name' => $name,
                ]);
            }
        }

        return redirect()->route('developerProfile', $developerProfile->id)->with('success', 'Developer profile updated successfully.');
    }

    public function handleTheImageUploadToS3(StoreDevProfileRequest $request, mixed $data): mixed
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            try {
                $uploadedImage = $request->file('image');

                // Generate a unique filename
                $fileName = 'profile_image_' . time() . '.' . $uploadedImage->getClientOriginalExtension();

                // Use the store method to store the file in the root of the 's3' disk
                $imagePath = $uploadedImage->storeAs('', $fileName, 's3');

                $s3Url = Storage::disk('s3')->url($imagePath);

                $data['image'] = $s3Url;
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
        return $data;
    }
}
