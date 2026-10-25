<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\SkillCategory;
use App\Models\Tag;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('admin/Dashboard', [
            'tags' => Tag::all(['id', 'name']),
            'categories' => SkillCategory::all(['id', 'name']),
            'resumeId' => Resume::query()->value('id'),
        ]);
    }
}
