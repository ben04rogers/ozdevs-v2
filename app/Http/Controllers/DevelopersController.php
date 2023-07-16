<?php

namespace App\Http\Controllers;

use App\Models\DeveloperProfile;
use Illuminate\Http\Request;

class DevelopersController extends Controller
{
    public function index(Request $request)
    {
        $query = DeveloperProfile::query();

        // Apply filters if provided
        if ($request->filled('city')) {
            $query->where('city', $request->input('city'));
        }

        if ($request->filled('experience_level')) {
            $query->where('role_level', $request->input('experience_level'));
        }

        // Retrieve filtered developers with pagination
        $developers = $query->paginate(15);

        // Append the query parameters to the pagination links
        $developers->appends($request->query());

        return view("developers", [
            'developers' => $developers,
        ]);
    }

}
