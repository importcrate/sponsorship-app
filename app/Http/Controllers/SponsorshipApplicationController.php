<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SponsorshipApplication;

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
            'email' => 'required|email',
            'cell_phone' => 'required|string',
            'street_address' => 'required|string',
            'street_address_2' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'instagram_username' => 'required|string',
            'tiktok_username' => 'nullable|string',
            'vehicle_year' => 'required|string',
            'vehicle_make' => 'required|string',
            'vehicle_model' => 'required|string',
            'modifications' => 'required|string',
            'other_sponsors' => 'nullable|string',
            'agree_rules' => 'accepted',
            'agree_banner' => 'accepted',
        ]);

        // Convert checkbox "on" values to true/false for DB
        $validated['agree_rules'] = $request->has('agree_rules');
        $validated['agree_banner'] = $request->has('agree_banner');

        // Add the current date for date_submitted
        $validated['date_submitted'] = now();

        // Save to the database
        SponsorshipApplication::create($validated);

        return redirect()->route('sponsorship.apply')->with('success', 'Your application has been submitted!');
    }
}
