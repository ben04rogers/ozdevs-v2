<?php

namespace App\Http\Controllers;

use App\Models\DeveloperProfile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {

        $developers = DeveloperProfile::limit(15)->get();

//        dump($developers);

        return view("home", [
            'developers' => $developers
        ]);
    }
}
