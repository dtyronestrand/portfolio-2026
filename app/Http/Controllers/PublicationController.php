<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function store(Request $request)
    {
        Publication::create($this->validatePublication($request, [
            'resume_id' => 'required|exists:resume,id',
        ]));

        return redirect()->back()->with('success', 'Publication added successfully.');
    }

    public function update(Request $request, Publication $publication)
    {
        $publication->update($this->validatePublication($request));

        return redirect()->back()->with('success', 'Publication updated successfully.');
    }

    public function destroy(Publication $publication)
    {
        $publication->delete();

        return redirect()->back()->with('success', 'Publication deleted successfully.');
    }

    private function validatePublication(Request $request, array $extraRules = []): array
    {
        return $request->validate($extraRules + [
            'title' => 'required|string|max:255',
            'authors' => 'nullable|string|max:255',
            'publisher' => 'required|string|max:255',
            'published_at' => 'required|date',
            'url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
        ]);
    }
}
