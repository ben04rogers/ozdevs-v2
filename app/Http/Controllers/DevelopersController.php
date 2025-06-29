<?php

namespace App\Http\Controllers;

use App\Models\DeveloperProfile;
use Illuminate\Http\Request;

class DevelopersController extends Controller
{
    public function index(Request $request)
    {
        $query = DeveloperProfile::query();

        if ($request->filled('state')) {
            $query->where('state', $request->input('state'));
        }

        if ($request->filled('experience_level')) {
            $query->where('role_level', $request->input('experience_level'));
        }

        $searchQuery = $request->query('search');

        if ($searchQuery) {
            $query->where(function ($subquery) use ($searchQuery): void {
                $subquery->whereRaw('LOWER(bio) LIKE ?', [sprintf('%%%s%%', $searchQuery)])
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

        $lengthAwarePaginator = $query->paginate(15);

        $lengthAwarePaginator->appends($request->query());

        return view("developers", [
            'developers' => $lengthAwarePaginator,
        ]);
    }
}
