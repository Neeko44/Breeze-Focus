<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Dashboard Admin</h1>

                <!-- Link ke halaman ubah role -->
                <a href="{{ route('manage.roles') }}"
                   class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">
                    Kelola Role User
                </a>

                <!-- Link ke halaman ubah role -->
                <a href="{{ route('artwork.index') }}"
                   class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">
                    Unggah Artwork
                </a>

                <!-- Logout -->
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="inline-block bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-300 ml-4">
                   Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
