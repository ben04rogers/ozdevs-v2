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
        if ($request->filled('state')) {
            $query->where('state', $request->input('state'));
        }

        if ($request->filled('experience_level')) {
            $query->where('role_level', $request->input('experience_level'));
        }

        $searchQuery = $request->query('search');

        // Search all developer attributes for the search query
        if ($searchQuery) {
            $query->where(function ($subquery) use ($searchQuery) {
                $subquery->where('name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('bio', 'like', '%' . $searchQuery . '%')
                    ->orWhere('state', 'like', '%' . $searchQuery . '%')
                    ->orWhere('hero', 'like', '%' . $searchQuery . '%')
                    ->orWhere('city', 'like', '%' . $searchQuery . '%')
                    ->orWhere('role_level', 'like', '%' . $searchQuery . '%')
                    ->orWhere('website', 'like', '%' . $searchQuery . '%')
                    ->orWhere('github', 'like', '%' . $searchQuery . '%')
                    ->orWhere('twitter', 'like', '%' . $searchQuery . '%')
                    ->orWhere('stack_overflow', 'like', '%' . $searchQuery . '%')
                    ->orWhere('linkedin', 'like', '%' . $searchQuery . '%');
            });
        }

        $query->whereIn('search_status', ['open', 'actively looking']);

        $query->orderByDesc('created_at');

        // Retrieve filtered developers with pagination
        $developers = $query->paginate(15);

        // Append the query parameters to the pagination links
        $developers->appends($request->query());

        return view("developers", [
            'developers' => $developers,
        ]);
    }
}
