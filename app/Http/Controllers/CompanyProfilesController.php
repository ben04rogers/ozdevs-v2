<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyProfileRequest;
use App\Http\Requests\StoreDevProfileRequest;
use App\Models\CompanyProfile;
use App\Models\DeveloperProfile;
use Faker\Provider\Company;
use Illuminate\Http\Request;

class CompanyProfilesController extends Controller
{
    public function index() {
        if (CompanyProfile::where('user_id', auth()->id())->exists()) {
            return redirect()->route('developers', auth()->user()->companyProfile->id)->with('warning', 'You have already created a company profile.');
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

        // Create a new company profile with the validated data
        $companyProfile = new CompanyProfile($data);

        // Set the user ID for the developer profile
        $companyProfile->user_id = auth()->id();

        // Save the developer profile
        $companyProfile->save();

        return redirect()->route('developers')->with('success', 'Company profile created successfully.');
    }
}
