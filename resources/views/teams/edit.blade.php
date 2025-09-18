<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier l\'équipe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">

                <!-- Messages -->
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Membres actuels de l'équipe -->
                @if($team->users->count())
                    <h3 class="text-lg font-medium mb-2">Membres actuels :</h3>
                    <ul class="mb-4 list-disc list-inside">
                        @foreach($team->users as $user)
                            <li>{{ $user->name }} ({{ $user->email }})</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 mb-4">Aucun membre pour le moment.</p>
                @endif

                <!-- Formulaire de modification de l'équipe -->
                <form action="{{ route('teams.update', $team->id) }}" method="POST" class="mb-6">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-1">Nom de l'équipe</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $team->name) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-medium mb-1">Description</label>
                        <textarea name="description" id="description"
                                  class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                  rows="4">{{ old('description', $team->description) }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('teams.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                            Annuler
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Mettre à jour
                        </button>
                    </div>
                </form>

                <!-- Formulaire d'invitation des utilisateurs -->
                <h3 class="text-lg font-medium mb-2">Inviter de nouveaux utilisateurs :</h3>

                @if($users->count())
                    <form action="{{ route('teams.invite', $team->id) }}" method="POST">
                        @csrf
                        <label for="users" class="block mb-1">Sélectionnez des utilisateurs :</label>
                        <select name="users[]" id="users" multiple class="w-full border-gray-300 rounded-md mb-2">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Inviter</button>
                    </form>
                @else
                    <p class="text-gray-500">Tous les utilisateurs ont déjà été invités à cette équipe.</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
