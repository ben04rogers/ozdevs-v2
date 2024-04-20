<?php

namespace App\Http\Controllers;

use App\Console\Commands\CreateCompanyProfileCommand;
use App\Http\Requests\StoreCompanyProfileRequest;
use App\Models\CompanyProfile;
use App\Models\DeveloperProfile;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Bus\DispatchesJobs;

class CompanyProfilesController extends Controller
{
    use DispatchesJobs;

    public function index() {

        if (DeveloperProfile::where('user_id', auth()->id())->exists()) {
            return redirect()->route('developerProfile', auth()->user()->developerProfile->id)->with('warning', 'You have already created a developer profile.');
        }

        if (CompanyProfile::where('user_id', auth()->id())->exists()) {
            return redirect()->route('companyProfile', auth()->user()->companyProfile->id)->with('warning', 'You have already created a company profile.');
        }

        return view("new-company");
    }

    public function store(StoreCompanyProfileRequest $request)
    {
        // Validate the request data
        $data = $request->validated();

        if (CompanyProfile::where('user_id', auth()->id())->exists()) {
            return response()->json([
                'message' => 'Company profile already exists',
            ], 400);
        }

        // Handle the image upload to S3
        $this->handleTheImageUploadToS3($request, $data);

        // Create company profile
        $this->dispatch(new CreateCompanyProfileCommand($data));

        return redirect()->route('companyProfile', auth()->user()->companyProfile->id)->with('success', 'Company profile created successfully.');
    }

    public function show($id)
    {
        // Find the company profile by ID
        $companyProfile = CompanyProfile::where('id', $id)->first();

        // Check if the company profile exists
        if (!$companyProfile) {
            // TODO: Change this to redirect somewhere else
            return redirect()->route('developers')->with('error', 'Company profile not found.');
        }

        // If everything is valid, return the view with the company profile data
        return view('company-profile', compact('companyProfile'));
    }

    public function edit($id)
    {
        // Users can only edit their own profile
        if (auth()->user()->companyProfile->id != $id) {
            return redirect()->route('developers')->with('error', 'You are not authorized to edit this profile.');
        }

        // Find the company profile by ID
        $companyProfile = CompanyProfile::where('id', $id)->first();

        // Check if the developer profile exists
        if (!$companyProfile) {
            return redirect()->route('developers')->with('error', 'Company profile not found.');
        }

        // Return the view with the developer profile data for editing
        return view('edit-company', compact('companyProfile'));
    }

    public function update(StoreCompanyProfileRequest $request, $id)
    {
        // Find the company profile by ID
        $companyProfile = CompanyProfile::where('user_id', $id)->first();

        // Check if the developer profile exists
        if (!$companyProfile) {
            return redirect()->route('developers')->with('error', 'Company profile not found.');
        }

        // Validate the request data
        $data = $request->validated();

        // Handle the image upload to S3
        $data = $this->handleTheImageUploadToS3($request, $data);

        $name = $data['staff_name'] ?? null;
        unset($data['staff_name']);

        // Update the developer profile with the validated data
        $companyProfile->update($data);

        // Update 'name' in the users table
        if ($name) {
            $user = User::find(auth()->id());
            if ($user) {
                $user->update([
                    'name' => $name,
                ]);
            }
        }

        return redirect()->route('companyProfile', $companyProfile->id)->with('success', 'Company profile updated successfully.');
    }

    /**
     * @param StoreCompanyProfileRequest $request
     * @param mixed $data
     * @return mixed
     */
    public function handleTheImageUploadToS3(StoreCompanyProfileRequest $request, mixed $data): mixed
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            try {
                $uploadedImage = $request->file('image');

                // Generate a unique filename (you can use any logic to generate a unique name)
                $fileName = 'company_image_' . time() . '.' . $uploadedImage->getClientOriginalExtension();

                // Use the store method to store the file in the root of the 's3' disk
                $imagePath = $uploadedImage->storeAs('', $fileName, 's3');

                // Get the S3 URL of the uploaded image
                $s3Url = Storage::disk('s3')->url($imagePath);

                $data['image'] = $s3Url;
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
        return $data;
    }
}
