@section('title', 'Car Shows. Style. Squad Vibes. This is the Mod Squad.')

@section('meta')
    <meta name="description" content="Not just a sponsorship — a statement. Import Crate’s Mod Squad connects car lovers across the country who live the culture. Style matters. Presence matters. Your build tells a story — join us.">
@endsection
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Sponsorship Application
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <p class="text-green-600 font-semibold">{{ session('success') }}</p>
            @endif

            <div class="mb-6 text-gray-700 space-y-4">
                <p class="font-semibold text-lg">
                    Think you’ve got what it takes to join the Mod Squad?
                </p>
                <p>
                    We review applications with care — we’re not just looking for mod lists, we’re looking for people who represent the scene the right way.
                    Fill out the form below to apply. We typically respond within 5 to 7 days. If approved, you'll receive instructions to activate your sponsorship and access the private Mod Squad member portal.
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-4 p-4 border border-red-400 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 p-4 border border-green-400 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('sponsorship.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
                @csrf
                <!-- Honeypot field -->
                <div style="display: none;">
                    <label for="company_name">Company Name</label>
                    <input type="text" name="company_name" id="company_name" autocomplete="off">
                </div>
                <!-- First Name and Last Name on same row -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium text-sm text-gray-700">First Name:</label>
                        <input type="text" name="first_name" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Last Name:</label>
                        <input type="text" name="last_name" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>

                <div>
                    <label class="block font-medium text-sm text-gray-700">Team Name:</label>
                    <input type="text" name="team_name"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Email:</label>
                        <input type="email" name="email" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Cell Phone:</label>
                        <input type="text" name="cell_phone" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>

{{--                 <div>
                    <label class="block font-medium text-sm text-gray-700">Street Address:</label>
                    <input type="text" name="street_address" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block font-medium text-sm text-gray-700">Street Address 2:</label>
                    <input type="text" name="street_address_2"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div> --}}

                <!-- City, State, Zip on same row -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Base City:</label>
                        <input type="text" name="city" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Base State:</label>
                        <select name="state" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="" disabled selected>Select a state</option>
                            @foreach ($states as $state)
                                <option value="{{ $state }}">{{ $state }}</option>
                            @endforeach
                        </select>
                    </div>
{{--                     <div>
                        <label class="block font-medium text-sm text-gray-700">Zip Code:</label>
                        <input type="text" name="zip_code" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div> --}}
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium text-sm text-gray-700">
                            Instagram Username <span class="text-xs text-gray-500">(profile must be public)</span>
                        </label>
                        <input type="text" name="instagram_username" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">
                            TikTok Username <span class="text-xs text-gray-500">(profile must be public)</span>
                        </label>
                        <input type="text" name="tiktok_username"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>


                <!-- Vehicle Information section -->
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mt-6">Vehicle Information</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-2">
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Year:</label>
                        <input type="text" name="vehicle_year" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Make:</label>
                        <input type="text" name="vehicle_make" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Model:</label>
                        <input type="text" name="vehicle_model" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">List of Modifications:</label>
                    <textarea name="modifications" required placeholder="List your vehicle modifications here" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Other Sponsors:</label>
                    <textarea name="other_sponsors" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                </div>

                <!-- Confirm Sponsorship Agreement -->
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mt-6">Confirm Sponsorship Agreement</h2>
                <p class="text-gray-600 dark:text-gray-300 mt-1">
                    In exchange for product sponsorship, Import Crate requires the following:
                </p>
                <ul class="list-disc list-inside text-gray-600 dark:text-gray-300 mb-4">
                    <li>Import Crate and Mod Squad brand decals to be placed on the vehicle in prominent locations</li>
                    <li>Social media posts including images of the vehicle with Import Crate products accompanied by the tags #importcrate #modsquad and @importcrate.</li>
                    <li>During Car Shows/Events, we require product display in or by your vehicle.</li>
                </ul>

                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input type="checkbox" name="agree_rules" required
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    </div>
                    <div class="ml-2 text-sm">
                        <label class="font-medium text-gray-700">
                            I have read, understand, and agree to the rules and regulations.
                        </label>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input type="checkbox" name="agree_banner" required
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    </div>
                    <div class="ml-2 text-sm">
                        <label class="font-medium text-gray-700">
                            I will display an Import Crate banner or decal on my vehicle.
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Password:</label>
                        <input type="password" name="password" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Confirm Password:</label>
                        <input type="password" name="password_confirmation" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>

                <div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
