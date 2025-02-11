<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Role User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Daftar User</h1>

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2">Nama</th>
                            <th class="border border-gray-300 px-4 py-2">Email</th>
                            <th class="border border-gray-300 px-4 py-2">Role</th>
                            <th class="border border-gray-300 px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->role }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <form action="{{ route('update.role', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <select name="role" class="border p-2 rounded">
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                            <option value="museum" {{ $user->role == 'museum' ? 'selected' : '' }}>Museum</option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>

                                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded ml-2 hover:bg-green-600">
                                            Ubah
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
