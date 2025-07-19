@section('title', 'Join a Culture of Custom Cars – The Mod Squad by Import Crate')

@section('meta')
    <meta name="description" content="The Mod Squad isn’t just a sponsorship. It’s a community for car lovers who express identity through clean builds, style, and how they show up. Join a nationwide team that represents the scene.">
@endsection
<x-app-layout>
    <div class="min-h-screen flex flex-col bg-white text-black">

        {{-- Centered Main Content --}}
        <div class="flex-1 flex flex-col items-center justify-center text-center px-4">
            <img src="{{ asset('images/mod-squad-logo.png') }}"
                 alt="Mod Squad Logo"
                 class="w-64 sm:w-80 mb-2" />

            <h1 class="text-3xl sm:text-4xl font-bold mb-2">Join the Mod Squad</h1>

            <a href="{{ route('sponsorship.apply') }}"
               class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded shadow transition mb-4">
                Apply for Sponsorship
            </a>

            <h2 class="text-lg sm:text-xl">
                The Official Car Sponsorship Program of Import Crate
            </h2>
        </div>

        {{-- Footer --}}
        <footer class="flex justify-between items-center text-sm text-gray-600 px-6 py-4 border-t">
            <span>© 2025 Import Crate & Mod Squad</span>
            <span>
                Powered by
                <a href="https://importcrate.com" target="_blank" class="text-red-600 hover:underline font-medium">
                    Import Crate
                </a>
            </span>
        </footer>

    </div>
</x-app-layout>
