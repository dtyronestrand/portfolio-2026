<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Inertia\Inertia;

class ResumeController extends Controller
{
    public function index()
    {
        $resume = Resume::query()
            ->with(['experiences' => fn ($query) => $query->orderByRaw('end_date is not null')->latest('end_date')->latest('start_date')])
            ->with(['educations' => fn ($query) => $query->latest('start_date')])
            ->with(['publications' => fn ($query) => $query->latest('published_at')])
            ->with('skills.skillCategory')
            ->first();

        if (! $resume) {
            return Inertia::render('Resume', ['resume' => null]);
        }

        $skillCategories = $resume->skills
            ->groupBy(fn (Skill $skill) => $skill->skillCategory->name ?? 'Other')
            ->map(fn ($skills, $name) => [
                'name' => $name,
                'skills' => $skills->map(fn (Skill $skill) => [
                    'id' => $skill->id,
                    'name' => $skill->name,
                    'level' => $skill->level->value,
                ])->values(),
            ])
            ->values();

        return Inertia::render('Resume', [
            'resume' => [
                'first_name' => $resume->first_name,
                'last_name' => $resume->last_name,
                'email' => $resume->email,
                'phone' => $resume->phone,
                // Street address stays private; city and state are enough for a public page.
                'location' => collect([$resume->address['city'] ?? null, $resume->address['state'] ?? null])->filter()->implode(', '),
                'summary' => $resume->summary,
                'experiences' => $this->pluck($resume->experiences, ['id', 'title', 'company', 'location', 'start_date', 'end_date', 'highlights']),
                'educations' => $this->pluck($resume->educations, ['id', 'school', 'degree', 'field_of_study', 'start_date', 'end_date', 'description']),
                'publications' => $this->pluck($resume->publications, ['id', 'title', 'authors', 'publisher', 'published_at', 'url', 'description']),
                'skill_categories' => $skillCategories,
            ],
        ]);
    }

    /**
     * Serialize models through toArray() so the date casts apply, keeping only the given keys.
     */
    private function pluck(Collection $models, array $keys): array
    {
        return $models->map(fn ($model) => Arr::only($model->toArray(), $keys))->all();
    }

    public function admin()
    {
        $resume = Resume::query()->with('skills')
            ->with('experiences')
            ->with('educations')
            ->with(['publications' => fn ($query) => $query->latest('published_at')])
            ->first();

        return Inertia::render('admin/Resume', [
            'resume' => $resume,
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|array',
            'address.street' => 'required|string|max:255',
            'address.city' => 'required|string|max:255',
            'address.state' => 'required|string|max:255',
            'summary' => 'required|string',
        ]);

        $resume = Resume::first();
        if (! $resume) {
            $resume = new Resume;
        }

        $resume->fill($validatedData);
        $resume->save();

        return redirect()->back()->with('success', 'Resume updated successfully.');
    }
}
