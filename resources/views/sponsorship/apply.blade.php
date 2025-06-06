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

            <form action="{{ route('sponsorship.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
                @csrf

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
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Team Name:</label>
                        <input type="text" name="team_name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
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
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Street Address:</label>
                        <input type="text" name="street_address" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Street Address 2:</label>
                        <input type="text" name="street_address_2"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">City:</label>
                        <input type="text" name="city" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>     
                    <div>
                        <label class="block font-medium text-sm text-gray-700">State:</label>
                        <select name="state" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach ($states as $state)
                                <option value="{{ $state }}">{{ $state }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Zip Code:</label>
                        <input type="text" name="zip_code" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>                     
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Instagram Username:</label>
                        <input type="text" name="instagram_username" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>                     
                    <div>
                        <label class="block font-medium text-sm text-gray-700">TikTok Username:</label>
                        <input type="text" name="tiktok_username" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div> 
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Vehicle Year:</label>
                        <input type="text" name="vehicle_year" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div> 
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Vehicle Make:</label>
                        <input type="text" name="vehicle_make" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div> 
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Vehicle Model:</label>
                        <input type="text" name="vehicle_model" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div> 
                    <div>
                        <label class="block font-medium text-sm text-gray-700">List of Modifications:</label>
                        <textarea name="modifications" required placeholder="List your vehicle modifications here" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>  
                    </div> 
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Other Sponsors:</label>
                        <textarea name="other_sponsors" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>  
                    </div> 
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="agree_rules" required
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        </div>
                        <div class="ml-2 text-sm">
                            <label for="agree_rules" class="font-medium text-gray-700">
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
                            <label for="agree_rules" class="font-medium text-gray-700">
                                I will display an Import Crate banner or decal on my vehicle.
                            </label>
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

