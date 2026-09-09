<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Skill;
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
