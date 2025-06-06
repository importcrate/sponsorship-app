<?php

namespace App\Http\Controllers;

use App\Models\SponsorshipApplication;
use Illuminate\Http\Request;


class AdminSponsorshipController extends Controller
{
    // List all sponsorship applications
    public function index()
    {
        $applications = SponsorshipApplication::orderBy('date_submitted', 'desc')->get();
        return view('admin.sponsorships.index', compact('applications'));
    }

    // Show a single application
    public function show($id)
    {
        $application = SponsorshipApplication::findOrFail($id);
        return view('admin.sponsorships.show', compact('application'));
    }

    // Approve an application
    public function approve($id)
    {
        $application = SponsorshipApplication::findOrFail($id);
        $application->status = 'Approved';
        $application->save();
        
        return redirect()->route('admin.sponsorships.index')->with('success', 'Application approved!');
    }

    //  Deny an application
    public function deny($id)
    {
        $application = SponsorshipApplication::findOrFail($id);
        $application->status = 'Denied';
        $application->save();

        return redirect()->route('admin.sponsorships.index')->with('success', 'Application denied');
    }
}
