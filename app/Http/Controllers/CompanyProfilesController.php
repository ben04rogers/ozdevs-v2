<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyProfileRequest;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CompanyProfilesController extends Controller
{
    public function index() {
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
        $data = $this->handleTheImageUploadToS3($request, $data);

        // Create a new company profile with the validated data
        $companyProfile = new CompanyProfile($data);

        // Set the user ID for the company profile
        $companyProfile->user_id = auth()->id();

        // Save the company profile
        $companyProfile->save();

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
