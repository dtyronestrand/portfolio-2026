<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $work = Project::all();
     return Inertia::render('work/Index', [
        'projects' => $work
     ]);
    }
    public function admin()
    {
        return Inertia::render('admin/Work', [
            'projects' => Project::all()
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
       $request->validate([
        'name' => 'required|string|max:255',
        'problem' => 'required|string',
        'product' => 'required|string',
        'hero' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'tags' => 'nullable|array',
        'attachments' => 'nullable|array',
       ]);

       $project = Project::create($request->only(['name', 'problem', 'product']));

        if ($request->hasFile('hero')) {
            $project->addMediaFromRequest('hero')->toMediaCollection('hero');
        }

        if ($request->has('tags')) {
            $project->tags()->sync($request->input('tags'));
        }

        return redirect()->route('admin.work')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
