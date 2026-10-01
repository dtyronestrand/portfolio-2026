<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'projects' => $work,
        ]);
    }

    public function admin()
    {
        return Inertia::render('admin/Work', [
            'projects' => Project::all(),
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'problem' => 'required|string',
            'product' => 'required|string',
            'hero' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'tags' => 'nullable|array',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|max:20480',
        ]);
        $mediaToRollback = [];

        try {
            DB::transaction(function () use ($request, $validated, $mediaToRollback) {
                $project = Project::create([
                    'name' => $validated['name'],
                    'problem' => $validated['problem'],
                    'product' => $validated['product'],
                ]);

                if ($request->filled('tags')) {
                    $project->tags()->sync($validated['tags']);
                }

                if ($request->hasFile('hero')) {
                    $media = $project->addMediaFromRequest('hero')->toMediaCollection('hero');

                    $mediaToRollback[] = $media;
                }
                if ($request->hasFile('attachments')) {
                    foreach ($request->file('attachments') as $index => $file) {
                        $media = $project->addMediaFromRequest("attachments.{$index}")->toMediaCollection('attachments');
                        $mediaToRollback[] = $media;
                    }
                }
            });
        } catch (Exception $e) {
            foreach ($mediaToRollback as $media) {
                try {
                    $media->delete();
                } catch (Exception $e) {
                }
            }
            throw $e;
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
