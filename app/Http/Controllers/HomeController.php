<?php

namespace App\Http\Controllers;

use App\Models\DeveloperProfile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $developers = DeveloperProfile::limit(15)->whereIn('search_status', ['actively looking', 'open'])->orderByDesc('created_at')->get();

        return view("home", [
            'developers' => $developers
        ]);
    }
}
