<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\SponsorshipApplication;
use Illuminate\Support\Facades\Mail;
use App\Mail\SponsorshipSubmitted;

class SponsorshipApplicationController extends Controller
{
    public function create()
    {
        $states = [
        'AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'FL', 'GA',
        'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MD',
        'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH', 'NJ',
        'NM', 'NY', 'NC', 'ND', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC',
        'SD', 'TN', 'TX', 'UT', 'VT', 'VA', 'WA', 'WV', 'WI', 'WY'
    ];
        return view('sponsorship.apply', compact('states'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'team_name' => 'nullable|string',
            'email' => 'required|email|unique:sponsorship_applications,email',
            'cell_phone' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'instagram_username' => 'required|string',
            'tiktok_username' => 'nullable|string',
            'vehicle_year' => 'required|string',
            'vehicle_make' => 'required|string',
            'vehicle_model' => 'required|string',
            'modifications' => 'required|string',
            'other_sponsors' => 'nullable|string',
            'agree_rules' => 'accepted',
            'agree_banner' => 'accepted',
            'password' => 'required|string|confirmed|min:8',
            'car_categories' => 'nullable|array',
            'car_category_other' => 'nullable|string',
            'event_preferences' => 'nullable|array',
        ]);

        // Handle car categories and event preferences
        $validated['car_categories'] = $request->input('car_categories', []);
        $validated['car_category_other'] = $request->input('car_category_other');
        $validated['event_preferences'] = $request->input('event_preferences', []);

        // Convert arrays to JSON for database storage
        $validated['car_categories'] = json_encode($validated['car_categories']);
        $validated['event_preferences'] = json_encode($validated['event_preferences']);

        // Convert checkboxes to booleans
        $validated['agree_rules'] = $request->has('agree_rules');
        $validated['agree_banner'] = $request->has('agree_banner');

        // Add current date
        $validated['date_submitted'] = now();

        // Create user account
        $user = User::create([
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        auth()->login($user);

        // Remove user-specific fields from $validated before inserting into application table
        unset($validated['password'], $validated['password_confirmation']);

        // Handle car categories and event preferences
        $validated['car_categories'] = $request->input('car_categories', []);
        $validated['car_category_other'] = $request->input('car_category_other');
        $validated['event_preferences'] = $request->input('event_preferences', []);

        // Convert arrays to JSON for database storage
        $validated['car_categories'] = json_encode($validated['car_categories']);
        $validated['event_preferences'] = json_encode($validated['event_preferences']);


        // Add user_id reference to application
        $validated['user_id'] = auth()->id();

        // Save application
        SponsorshipApplication::create($validated);

        // Send confirmation email
        Mail::to($user->email)->send(new SponsorshipSubmitted($user));

        // Redirect to dashboard
        return redirect()->route('dashboard')->with('success', 'Your application has been submitted!');
    }
}
