@section('title', 'Car Shows. Style. Squad Vibes. This is the Mod Squad.')

@section('meta')
    <meta name="description" content="Not just a sponsorship — a statement. Import Crate’s Mod Squad connects car lovers across the country who live the culture. Style matters. Presence matters. Your build tells a story — join us.">
@endsection
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Application Details
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow rounded-lg p-6 space-y-4">
                <!-- Basic Info (2 columns) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Name:</strong></p>
                        <p class="text-gray-900 dark:text-gray-100">{{ $application->first_name }} {{ $application->last_name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Team:</strong></p>
                        <p class="text-gray-900 dark:text-gray-100">{{ $application->team_name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Email:</strong></p>
                        <p class="text-gray-900 dark:text-gray-100">{{ $application->email }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Cell Phone:</strong></p>
                        <p class="text-gray-900 dark:text-gray-100">{{ $application->cell_phone }}</p>
                    </div>
                </div>

                <!-- Address: its own row -->
                <div>
                    <p class="text-gray-600 dark:text-gray-300"><strong>Address:</strong></p>
                    <p class="text-gray-900 dark:text-gray-100">{{ $application->street_address }} {{ $application->street_address_2 }}, {{ $application->city }}, {{ $application->state }} {{ $application->zip_code }}</p>
                </div>

                <!-- Instagram & TikTok: same row -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Instagram:</strong></p>
                        <p class="text-gray-900 dark:text-gray-100">{{ $application->instagram_username }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-300"><strong>TikTok:</strong></p>
                        <p class="text-gray-900 dark:text-gray-100">{{ $application->tiktok_username }}</p>
                    </div>
                </div>

                <!-- Vehicle: its own row -->
                <div>
                    <p class="text-gray-600 dark:text-gray-300"><strong>Vehicle:</strong></p>
                    <p class="text-gray-900 dark:text-gray-100">{{ $application->vehicle_year }} {{ $application->vehicle_make }} {{ $application->vehicle_model }}</p>
                </div>

                <!-- Modifications under Vehicle -->
                <div>
                    <p class="text-gray-600 dark:text-gray-300"><strong>Modifications:</strong></p>
                    <p class="text-gray-900 dark:text-gray-100">{{ $application->modifications }}</p>
                </div>

                <!-- Other Sponsors: its own row -->
                <div>
                    <p class="text-gray-600 dark:text-gray-300"><strong>Other Sponsors:</strong></p>
                    <p class="text-gray-900 dark:text-gray-100">{{ $application->other_sponsors }}</p>
                </div>

                <!-- Agree to Rules & Display Banner: same row -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Agree to Rules:</strong></p>
                        <p class="text-gray-900 dark:text-gray-100">{{ $application->agree_rules ? 'Yes' : 'No' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Display Banner:</strong></p>
                        <p class="text-gray-900 dark:text-gray-100">{{ $application->agree_banner ? 'Yes' : 'No' }}</p>
                    </div>
                </div>

            <!-- Status: its own row -->
            <div>
                <p class="text-gray-600 dark:text-gray-300"><strong>Status:</strong></p>
                @if ($application->status === 'Pending')
                    <span class="inline-block px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 font-semibold">
                        {{ ucfirst($application->status) }}
                    </span>
                @elseif ($application->status === 'Approved')
                    <span class="inline-block px-2 py-1 rounded-full bg-green-100 text-green-800 font-semibold">
                        {{ ucfirst($application->status) }}
                    </span>
                @else
                    <span class="inline-block px-2 py-1 rounded-full bg-red-100 text-red-800 font-semibold">
                        {{ ucfirst($application->status) }}
                    </span>
                @endif
            </div>

            <!-- Approved by: show if status is Approved or Pending -->
            @if ($application->status === 'Approved' || $application->status === 'Pending')
                <div>
                    <p class="text-gray-600 dark:text-gray-300"><strong>Approved by:</strong></p>
                    <p class="text-gray-900 dark:text-gray-100">
                        {{ $application->approved_by ?? 'Not yet approved' }}
                    </p>
                </div>
            @endif

            <!-- Denial reason: show if status is Denied or Pending -->
            @if ($application->status === 'Denied' || $application->status === 'Pending')
                <div>
                    <p class="text-gray-600 dark:text-gray-300"><strong>Denial reason:</strong></p>
                    <p class="text-gray-900 dark:text-gray-100">
                        {{ $application->denial_reason ?? 'Not yet denied' }}
                    </p>
                </div>
            @endif




                <!-- Action Buttons -->
                <div class="mt-6 space-y-2">
                    @if ($application->status !== 'Approved')
                        <!-- Approve button -->
                        <form action="{{ route('admin.sponsorships.approve', $application->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-100 text-green-800 px-4 py-2 rounded hover:bg-green-200">Approve</button>
                        </form>
                    @endif

                    @if ($application->status !== 'Denied')
                        <!-- Deny button and textarea (same line, below Approve) -->
                        <form action="{{ route('admin.sponsorships.deny', $application->id) }}" method="POST" class="flex flex-col sm:flex-row sm:items-center sm:space-x-2">
                            @csrf
                            <textarea name="denial_reason" required placeholder="Reason for denial" class="border rounded p-2 sm:w-64 mb-2 sm:mb-0"></textarea>
                            <button type="submit" class="bg-red-100 text-red-800 px-4 py-2 rounded hover:bg-red-200">Deny</button>
                        </form>
                    @endif

                    <!-- Back to List link (always shown) -->
                    <a href="{{ route('admin.sponsorships.index') }}" class="inline-block bg-gray-100 text-gray-800 px-4 py-2 rounded hover:bg-gray-200">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
