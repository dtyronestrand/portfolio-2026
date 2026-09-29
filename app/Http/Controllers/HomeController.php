<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $skills = Skill::all();

        return Inertia::render('Home', [
            'skills' => $skills,
        ]);
    }
}
