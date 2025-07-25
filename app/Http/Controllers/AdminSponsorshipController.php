<?php

namespace App\Http\Controllers;

use App\Models\SponsorshipApplication;
use Illuminate\Http\Request;
use App\Mail\ApplicationStatusUpdated;
use Illuminate\Support\Facades\Mail;


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
        $application->approved_by = auth()->user()->name; // record who approved
        $application->save();

        // Send email
        Mail::to($application->email)->send(new ApplicationStatusUpdated($application));

        return redirect()->route('admin.sponsorships.index')->with('success', 'Application approved and email sent.');
    }


    //  Deny an application
    public function deny(Request $request, $id)
    {
        $request->validate([
            'denial_reason' => 'required|string|max:1000'
        ]);

        $application = SponsorshipApplication::findOrFail($id);
        $application->status = 'Denied';
        $application->denial_reason = $request->input('denial_reason');
        $application->save();

        // Send email to the applicant
        Mail::to($application->email)->send(new ApplicationStatusUpdated($application));

        return redirect()->route('admin.sponsorships.index')->with('success', 'Application denied and email sent.');
    }

    //  Delete an application
    public function destroy($id)
    {
        $application = SponsorshipApplication::with('user')->findOrFail($id);

        // Soft delete the application
        $application->delete();

        // Delete the associated user
        if ($application->user) {
            $application->user->delete(); // hard delete (not soft)
        }

        return redirect()->route('admin.sponsorships.index')
            ->with('success', 'Application and associated user deleted.');
    }


}
