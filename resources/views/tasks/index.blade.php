<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tâches') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Bouton créer une tâche -->
            <div class="flex justify-end mb-4">
                <a href="{{ route('tasks.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-black px-4 py-2 rounded shadow">
                    Nouvelle tâche
                </a>
            </div>

            <!-- Filtrage et recherche -->
            <form method="GET" action="{{ route('tasks.index') }}" class="mb-4 flex space-x-4">
                <input type="text" name="q" placeholder="Rechercher..." value="{{ request('q') }}"
                    class="border rounded px-2 py-1">

                <select name="status" class="border rounded px-2 py-1">
                    <option value=""> Statut  </option>
                    <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Ouverte</option>
                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Fermée</option>
                </select>

                <button type="submit" class="bg-blue-500 text-gray px-3 py-1 rounded">Filtrer</button>
                <a href="{{ route('tasks.index') }}" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">Réinitialiser</a>
            </form>

            <!-- Tableau des tâches -->
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Équipe</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fichier</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Commentaires</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($tasks as $task)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $task->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $task->description ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $task->team->name ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if($task->file)
                                        <a href="{{ asset('storage/' . $task->file) }}" class="text-blue-600 underline" target="_blank">
                                            Télécharger
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($task->status == 'open')
                                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Ouverte</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded bg-gray-200 text-gray-700">Fermée</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @foreach($task->comments as $comment)
                                        <div class="p-1 border-b">
                                            <div class="flex justify-between items-center">
                                                <strong>{{ $comment->user->name }}</strong>
                                                <div class="space-x-2">
                                                    @can('update', $comment)
                                                        <a href="{{ route('comments.edit', $comment->id) }}" class="text-indigo-600 hover:underline text-sm">Modifier</a>
                                                    @endcan
                                                    @can('delete', $comment)
                                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:underline text-sm"
                                                                    onclick="return confirm('Voulez-vous vraiment supprimer ce commentaire ?')">Supprimer</button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </div>
                                            <p class="mt-1">{{ $comment->body }}</p>
                                            <small class="text-gray-400">{{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                    @endforeach

                                    <!-- Formulaire pour ajouter un commentaire -->
                                    <form action="{{ route('comments.store', $task) }}" method="POST" class="mt-2">
                                        @csrf
                                        <textarea name="body" rows="2" class="w-full border rounded p-1" placeholder="Écrire un commentaire..."></textarea>
                                        <button type="submit" class="mt-1 px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Commenter</button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    @can('update', $task)
                                        <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-600 hover:underline">Modifier</a>
                                    @endcan
                                    @can('delete', $task)
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline"
                                                onclick="return confirm('Voulez-vous vraiment supprimer cette tâche ?')">Supprimer</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">Aucune tâche pour le moment.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
