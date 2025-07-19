<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // Always update the most recent announcement, or create one if none exists
        $announcement = Announcement::latest()->first();

        if ($announcement) {
            $announcement->body = $request->body;
            $announcement->save();
        } else {
            Announcement::create(['body' => $request->body]);
        }

        return redirect()->route('dashboard')->with('success', 'Announcement updated.');
    }
}
