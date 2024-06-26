<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyProfileRequest;
use App\Jobs\CreateCompanyProfileJob;
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
        $data = $request->validated();

        if (CompanyProfile::where('user_id', auth()->id())->exists()) {
            return response()->json([
                'message' => 'Company profile already exists',
            ], 400);
        }

        $this->handleTheImageUploadToS3($request, $data);

        dispatch(new CreateCompanyProfileJob($data));

        return redirect()->route('companyProfile', auth()->user()->companyProfile->id)->with('success', 'Company profile created successfully.');
    }

    public function show($id)
    {
        $companyProfile = CompanyProfile::where('id', $id)->first();

        if (!$companyProfile) {
            // TODO: Change this to redirect somewhere else
            return redirect()->route('developers')->with('error', 'Company profile not found.');
        }

        return view('company-profile', compact('companyProfile'));
    }

    public function edit($id)
    {
        if (auth()->user()->companyProfile->id != $id) {
            return redirect()->route('developers')->with('error', 'You are not authorized to edit this profile.');
        }

        $companyProfile = CompanyProfile::where('id', $id)->first();

        if (!$companyProfile) {
            return redirect()->route('developers')->with('error', 'Company profile not found.');
        }

        return view('edit-company', compact('companyProfile'));
    }

    public function update(StoreCompanyProfileRequest $request, $id)
    {
        $companyProfile = CompanyProfile::where('user_id', $id)->first();

        if (!$companyProfile) {
            return redirect()->route('developers')->with('error', 'Company profile not found.');
        }

        $data = $request->validated();

        $data = $this->handleTheImageUploadToS3($request, $data);

        $name = $data['staff_name'] ?? null;
        unset($data['staff_name']);

        $companyProfile->update($data);

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

                // Generate a unique filename
                $fileName = 'company_image_' . time() . '.' . $uploadedImage->getClientOriginalExtension();

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
