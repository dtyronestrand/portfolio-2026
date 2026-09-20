<?php

namespace App\Http\Controllers;

use App\Models\SkillCategory;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Inertia\Inertia;
use App\Enums\SkillLevel;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function admin()
    {
       $categories = SkillCategory::all()->load('skills')->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'skills' => $category->skills->map(function ($skill) {
                    return [
                        'id' => $skill->id,
                        'name' => $skill->name,
                        'level' => $skill->level,
                    ];
                }),
            ];
        });
        return Inertia::render('admin/Skills', [
           'categories' => $categories
        ]); 
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $skill = $request->validate([
            'name' => 'required|string|max:255',
            'level' => ['required', new Enum(SkillLevel::class)],
            'skill_category_id' => 'required|exists:skill_categories,id',
        ]);
        Skill::create($skill);
        return redirect()->route('admin.skills')->with('success', 'Skill created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        //
    }
}
