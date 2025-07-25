@section('title', 'Car Shows. Style. Squad Vibes. This is the Mod Squad.')

@section('meta')
    <meta name="description" content="Not just a sponsorship — a statement. Import Crate’s Mod Squad connects car lovers across the country who live the culture. Style matters. Presence matters. Your build tells a story — join us.">
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 text-green-600 dark:text-green-300">
                    {{ session('success') }}
                </div>
            @endif

            @if (auth()->user()->is_admin)
                <form action="{{ route('announcement.update') }}" method="POST">
                    @csrf
                    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                        <label for="body" class="block font-medium text-sm text-gray-700 dark:text-gray-200 mb-2">
                            📢 Edit Announcement
                        </label>
                        <textarea name="body" id="body" rows="4" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm">{{ old('body', $announcement->body ?? '') }}</textarea>
                        <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Save Announcement
                        </button>
                    </div>
                </form>
            @else

                @php
                    $application = auth()->user()->sponsorshipApplication;
                @endphp

                @if ($application)
                    @php $status = strtolower($application->status); @endphp

                    @if ($status === 'pending')
                        <div class="bg-yellow-100 text-yellow-800 p-6 rounded-lg shadow">
                            <h2 class="text-xl font-bold mb-2">Application Status: Pending</h2>
                            <p>Thanks for applying! Your sponsorship application is currently under review.</p>
                            <p>We typically respond within 5–7 days. Stay tuned!</p>
                        </div>
                    @elseif ($status === 'denied')
                        <div class="bg-red-100 text-red-800 p-6 rounded-lg shadow space-y-2">
                            <h2 class="text-xl font-bold mb-2">Application Status: Denied</h2>
                            <p><strong>Reason:</strong> {{ $application->denial_reason ?? 'Not provided' }}</p>
                            <p>If you believe this can be resolved, feel free to submit a new application when ready.</p>
                        </div>
                    @elseif ($status === 'approved')
                        {{-- Approved view content --}}

                        @if ($announcement)
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">📢 Announcement</h3>
                                <p class="text-gray-700 dark:text-gray-300">{{ $announcement->body }}</p>
                            </div>
                        @else
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                                <p class="text-gray-700 dark:text-gray-300">No announcements at this time.</p>
                            </div>
                        @endif

                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                            <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Welcome to the Mod Squad</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                You’re officially part of Import Crate’s curated driver network — a group of builders selected not just for their cars, but for how they represent the scene.
                            </p>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                Mod Squad isn’t just about having mods. It’s about having pride, presence, and potential. Whether you're repping at a meet, posting online, or showing love to others in the community, you stand out — and now you’re on our radar.
                            </p>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                From time to time, we’ll share exclusive drops only available to Mod Squad members.
                                When you're ready, those will show up right here in your portal.
                            </p>

                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                As a Mod Squad member, you may be invited to display your car at vetted shows and partner events powered by CrateOS. You’ll also get first access to exclusive merch drops and lowkey perks along the way.
                            </p>

                            <p class="text-gray-700 dark:text-gray-300 italic mb-6">
                                No matter where you're from, you're part of the crew now.
                                We're hyped to have you with us.
                            </p>

                            <p class="text-sm text-gray-500 dark:text-gray-400 italic mt-6">
                                Note: This portal is for informational purposes only. You do not need to take any action unless instructed.
                                Features and updates will be added over time, so feel free to check back occasionally.
                            </p>

                            <div class="mt-10 p-6 rounded-xl bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 shadow-lg">
                                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 dark:text-white mb-3">Looking for Meets to Attend?</h2>

                                <a href="https://crateonscene.com" target="_blank" class="inline-block text-lg font-semibold text-indigo-600 hover:text-indigo-500 underline mb-2">
                                    ➤ View Upcoming Events on CrateOS
                                </a>

                                <p class="text-gray-700 dark:text-gray-300 mb-2">
                                    CrateOS is our official platform for discovering car meets and shows we recommend. Browse upcoming events and RSVP directly on the site.
                                </p>

                                <p class="text-gray-700 dark:text-gray-300">
                                    When attending, make sure to let the event organizer know you're representing as <strong>Mod Squad by Import Crate</strong> — especially if you’re placing your car in the show.
                                </p>
                            </div>

                            <div class="mt-6 text-sm text-gray-600 dark:text-gray-400">
                                <p class="mb-2">Stay connected:</p>
                                <ul class="list-disc list-inside">
                                    <li><a href="https://instagram.com/importcrate" class="underline hover:text-indigo-600" target="_blank">Follow us on Instagram</a></li>
                                    <li><a href="https://tiktok.com/@importcrate" class="underline hover:text-indigo-600" target="_blank">Follow us on TikTok</a></li>
                                </ul>
                            </div>
                        </div>

                    @else
                        <div class="bg-gray-100 text-gray-800 p-6 rounded-lg shadow">
                            <h2 class="text-xl font-bold mb-2">Application Status: Unknown</h2>
                            <p>Your application has an unrecognized status: <strong>{{ $application->status }}</strong></p>
                        </div>
                    @endif
                @else
                    <div class="bg-blue-100 text-blue-800 p-6 rounded-lg shadow">
                        <h2 class="text-xl font-bold mb-2">You haven’t submitted an application yet.</h2>
                        <p><a href="{{ route('sponsorship.apply') }}" class="text-blue-700 underline font-semibold">Click here to apply now.</a></p>
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>
