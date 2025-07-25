<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\SponsorshipApplication;
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
        // Validate form fields
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

        // Create user and log in
        $user = User::create([
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        auth()->login($user);

        // Prepare sponsorship application data
        $applicationData = [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'team_name' => $validated['team_name'] ?? null,
            'email' => $validated['email'],
            'cell_phone' => $validated['cell_phone'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'instagram_username' => $validated['instagram_username'],
            'tiktok_username' => $validated['tiktok_username'] ?? null,
            'vehicle_year' => $validated['vehicle_year'],
            'vehicle_make' => $validated['vehicle_make'],
            'vehicle_model' => $validated['vehicle_model'],
            'modifications' => $validated['modifications'],
            'other_sponsors' => $validated['other_sponsors'] ?? null,
            'agree_rules' => true,
            'agree_banner' => true,
            'car_categories' => json_encode($request->input('car_categories', [])),
            'car_category_other' => $validated['car_category_other'] ?? null,
            'event_preferences' => json_encode($request->input('event_preferences', [])),
            'date_submitted' => now(),
            'user_id' => $user->id,
        ];

        // Save sponsorship application
        SponsorshipApplication::create($applicationData);

        // Send confirmation email
        Mail::to($user->email)->send(new SponsorshipSubmitted($user));

        return redirect()->route('dashboard')->with('success', 'Your application has been submitted!');
    }
}
