<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer une tâche') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">

<form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Titre -->
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-medium mb-1">Titre de la tâche</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-medium mb-1">Description</label>
                        <textarea name="description" id="description"
                                  class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                  rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date d'échéance -->
            <div class="mb-4">
    <label for="due_date" class="block text-gray-700 font-medium mb-1">Date d'échéance</label>
    <input type="date" name="due_date" id="due_date"
           value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
    @error('due_date')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>




                    <!-- Équipe -->
                    <div class="mb-4">
                        <label for="team_id" class="block text-gray-700 font-medium mb-1">Équipe</label>
                        <select name="team_id" id="team_id"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-black">
                            <option value="">-- Choisir une équipe --</option>
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>
                                    {{ $team->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('team_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fichier -->
                    <div class="mb-4">
                        <label for="file" class="block text-gray-700 font-medium mb-1">Fichier</label>
                        <input type="file" name="file" id="file" class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('file')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
<div class="mb-4">
    <label for="status" class="block text-gray-700 font-medium mb-1">Statut</label>
    <select name="status" id="status" class="w-full border-gray-300 rounded-md shadow-sm">
        <option value="open" {{ old('status', $task->status ?? '') == 'open' ? 'selected' : '' }}>Ouverte</option>
        <option value="closed" {{ old('status', $task->status ?? '') == 'closed' ? 'selected' : '' }}>Fermée</option>
    </select>
    @error('status')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

                    <!-- Boutons -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                            Annuler
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Créer
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
