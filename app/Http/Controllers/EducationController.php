<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Resume;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $this->validateEducation($request);

        $resume = $request->resume_id ? Resume::find($request->resume_id) : null;
        $education = new Education($validatedData);
        if ($resume) {
            $education->resume()->associate($resume);
        }
        $education->save();

        return redirect()->back()->with('success', 'Education entry added successfully.');
    }

    public function update(Request $request, Education $education)
    {
        $education->update($this->validateEducation($request));

        return redirect()->back()->with('success', 'Education entry updated successfully.');
    }

    public function destroy(Education $education)
    {
        $education->delete();

        return redirect()->back()->with('success', 'Education entry deleted successfully.');
    }

    private function validateEducation(Request $request): array
    {
        $validatedData = $request->validate([
            'school' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        // The description column is not nullable.
        $validatedData['description'] ??= '';

        return $validatedData;
    }
}
