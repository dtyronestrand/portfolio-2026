<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    /**
     * Media collections that accept multiple uploads (hero is handled separately as a single file).
     *
     * @var list<string>
     */
    private const MEDIA_COLLECTIONS = ['gallery', 'storyboard', 'design_docs', 'video'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ⚡ Bolt: Eager load 'tags' and 'media' so the resource doesn't run extra queries per project.
        $projects = Project::with(['tags', 'media'])->orderBy('sort_order')->get();

        // Spread the resource's response body into the props so the wrap key
        // ("projects") becomes the prop name instead of a nested "data" key.
        return Inertia::render('work/Index', (new ProjectCollection($projects))->response()->getData(true));
    }

    public function admin()
    {
        // ⚡ Bolt: Eager load 'tags' and 'media' so the resource doesn't run extra queries per project.
        $projects = Project::with(['tags', 'media'])->orderBy('sort_order')->get();

        return Inertia::render('admin/Work', [
            ...(new ProjectCollection($projects))->response()->getData(true),
            'tags' => Tag::all(),
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
            'slug' => 'nullable|string|max:255|alpha_dash|unique:projects,slug',
            'summary' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'audience' => 'required|string|max:255',
            'completed_at' => 'required|string|max:255',
            'challenge' => 'required|string',
            'solution' => 'required|string',
            'modality' => 'required|string|max:255',
            'learning_objectives' => 'required|array|min:1',
            'learning_objectives.*' => 'string|max:255',
            'process' => 'required|string',
            'seat_time' => 'nullable|string|max:255',
            'design_rationale' => 'required|string',
            'demo_url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_published' => 'boolean',
            'featured' => 'boolean',
            'reflection' => 'nullable|string',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:255',
            'hero' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:5120',
            'storyboard' => 'nullable|array',
            'storyboard.*' => 'file|max:20480',
            'design_docs' => 'nullable|array',
            'design_docs.*' => 'file|max:20480',
            'video' => 'nullable|array',
            'video.*' => 'file|mimetypes:video/mp4,video/webm,video/quicktime|max:204800',
        ]);
        $mediaToRollback = [];

        try {
            DB::transaction(function () use ($request, $validated, &$mediaToRollback) {
                $project = Project::create([
                    ...Arr::except($validated, ['tags', 'hero', ...self::MEDIA_COLLECTIONS]),
                    'slug' => $validated['slug'] ?? Str::slug($validated['name']),
                    'sort_order' => $validated['sort_order'] ?? 0,
                    'is_published' => $request->boolean('is_published'),
                    'featured' => $request->boolean('featured'),
                ]);

                if ($request->filled('tags')) {
                    $tagIds = collect($validated['tags'])
                        ->map(fn(string $name) => Tag::firstOrCreate(['name' => $name])->id);
                    $project->tags()->sync($tagIds);
                }

                if ($request->hasFile('hero')) {
                    $mediaToRollback[] = $project->addMediaFromRequest('hero')->toMediaCollection('hero');
                }

                foreach (self::MEDIA_COLLECTIONS as $collection) {
                    foreach (array_keys($request->file($collection, [])) as $index) {
                        $mediaToRollback[] = $project->addMediaFromRequest("{$collection}.{$index}")->toMediaCollection($collection);
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
        $project->load(['tags', 'media']);

        return Inertia::render('work/Show', (new ProjectResource($project))->response()->getData(true));
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
