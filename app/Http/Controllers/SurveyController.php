<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SurveySubmitted;
use App\Models\Survey;

class SurveyController extends Controller
{
    public function index()
    {
        return view('survey.form');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'addressing_to' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'suggestions' => 'required|string|max:255',
        ]);

        // Save survey to database
        Survey::create($validated);

        // Send email with error handling
        try {
            Mail::to(env('SURVEY_EMAIL', 'admin@example.com'))
                ->send(new SurveySubmitted($validated));
        } catch (\Exception $e) {
            // Log the error but don't show it to the user
            \Log::error('Survey email failed: ' . $e->getMessage());

            // Still show success to user since survey was saved
            // Optionally, you could notify admins via another method
        }

        return redirect()->route('survey.form')
            ->with('success', 'Thank you! Your survey has been submitted successfully.');
    }
}
