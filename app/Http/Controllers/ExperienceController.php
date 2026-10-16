<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Resume;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $this->validateExperience($request);
        $resume = $request->resume_id ? Resume::find($request->resume_id) : null;
        $experience = new Experience($validatedData);

        if ($resume) {

            $experience->resume()->associate($resume);
        }

        $experience->save();

        return redirect()->back()->with('success', 'Experience added successfully.');
    }

    public function update(Request $request, Experience $experience)
    {
        $validatedData = $this->validateExperience($request);
        $experience->update($validatedData);

        return redirect()->back()->with('success', 'Experience updated successfully.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        return redirect()->back()->with('success', 'Experience deleted successfully.');
    }

    private function validateExperience(Request $request): array
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'nullable|string',
            'highlights' => 'nullable|array',
        ]);

        return $validatedData;
    }
}
