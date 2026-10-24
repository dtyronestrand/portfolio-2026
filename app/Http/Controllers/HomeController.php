<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectCollection;
use App\Models\Project;
use App\Models\Skill;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Maximum number of featured projects shown on the home page.
     */
    private const FEATURED_LIMIT = 3;

    public function index()
    {
        $skills = Skill::all();

        // Eager load 'tags' and ONLY 'hero' media, matching the work index, so the resource doesn't over-fetch.
        $projects = Project::where('is_published', true)
            ->where('featured', true)
            ->with(['tags', 'media' => fn ($q) => $q->where('collection_name', 'hero')])
            ->orderBy('sort_order')
            ->limit(self::FEATURED_LIMIT)
            ->get();

        return Inertia::render('Home', [
            'skills' => $skills,
            ...(new ProjectCollection($projects))->response()->getData(true),
        ]);
    }
}
