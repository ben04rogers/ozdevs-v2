<?php

namespace App\Http\Controllers;

use App\Models\DeveloperProfile;
use Illuminate\Http\Request;

class DevelopersController extends Controller
{
    public function index() {

        $developers = DeveloperProfile::paginate(15);

        return view("developers", [
            'developers' => $developers,
        ]);
    }
}
