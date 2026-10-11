<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ResumeController extends Controller
{
    public function admin()
    {
        $resume = Resume::query()->with('skills')
            ->with('experiences')
            ->with('educations')
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
