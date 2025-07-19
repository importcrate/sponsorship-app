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
                        <textarea name="body" id="body" rows="4" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm">
                            {{ old('body', $announcement->body ?? '') }}
                        </textarea>
                        <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Save Announcement
                        </button>
                    </div>
                </form>
            @else
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
                            You’ve officially joined a movement that goes beyond just builds and meets.
                            The Mod Squad is a collective of drivers who represent what’s next in the scene — not just with what they drive, but how they show up.
                        </p>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            What makes a true Mod Squad member? Pride in your ride. Respect for the community. And showing love to others who keep the culture alive.
                            Whether you're repping at a local meet or sharing your build online, you're part of something that stands out.
                        </p>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            From time to time, we’ll share exclusive drops only available to Mod Squad members.
                            When you're ready, those will show up right here in your portal.
                        </p>
                        <p class="text-gray-700 dark:text-gray-300 italic mb-6">
                            No matter where you're from, you're part of the crew now.
                            We're hyped to have you with us.
                        </p>
                        
                        <p class="text-sm text-gray-500 dark:text-gray-400 italic mt-6">
                            Note: This portal is for informational purposes only. You do not need to take any action unless instructed.
                            Features and updates will be added over time, so feel free to check back occasionally.
                        </p>

                        <div class="border-t border-gray-300 dark:border-gray-700 pt-4 mt-4 text-sm text-gray-600 dark:text-gray-400">
                            <p>— Mod Squad<br><span class="text-xs">powered by Import Crate</span></p>
                        </div>

                        <div class="mt-6 text-sm text-gray-600 dark:text-gray-400">
                            <p class="mb-2">Stay connected:</p>
                            <ul class="list-disc list-inside">
                                <li><a href="https://importcrate.com/pages/events" class="underline hover:text-indigo-600" target="_blank">See what shows we’re attending</a></li>
                                <li><a href="https://instagram.com/importcrate" class="underline hover:text-indigo-600" target="_blank">Follow us on Instagram</a></li>
                                <li><a href="https://tiktok.com/@importcrate" class="underline hover:text-indigo-600" target="_blank">Follow us on TikTok</a></li>
                            </ul>
                        </div>
                    </div>
            @endif
        </div>
    </div>
</x-app-layout>
