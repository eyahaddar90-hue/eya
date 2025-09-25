<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="page-title">Mes tâches</h1>
                <p class="page-subtitle">Gérez et suivez vos tâches</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('tasks.create') }}" class="btn-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nouvelle tâche
                </a>
            </div>
        </div>
    </x-slot>

    <div class="p-6">
        <!-- Filtres et recherche -->
        <div class="modern-card p-6 mb-8">
            <form method="GET" action="{{ route('tasks.index') }}" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="q" placeholder="Rechercher des tâches..." value="{{ request('q') }}"
                               class="form-input pl-10">
                    </div>
                </div>
                
                <div class="flex gap-3">
                    <select name="status" class="form-select">
                        <option value="">Tous les statuts</option>
                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Ouvertes</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Fermées</option>
                    </select>
                    
                    <button type="submit" class="btn-primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                        </svg>
                        Filtrer
                    </button>
                    
                    <a href="{{ route('tasks.index') }}" class="btn-secondary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Réinitialiser
                    </a>
                </div>
            </form>
        </div>

        <!-- Liste des tâches -->
        @if($tasks->count() > 0)
            <div class="task-grid">
                @foreach($tasks as $task)
                    <div class="modern-card animate-fade-in" style="animation-delay: {{ $loop->index * 0.1 }}s">
                        <!-- En-tête de la carte -->
                        <div class="p-6 border-b border-neutral-200">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-neutral-900 mb-2">{{ $task->title }}</h3>
                                    <p class="text-sm text-neutral-600 line-clamp-2">{{ $task->description }}</p>
                                </div>
                                <div class="flex items-center space-x-2 ml-4">
                                    <span class="status-badge {{ $task->status == 'open' ? 'status-open' : 'status-closed' }}">
                                        {{ $task->status == 'open' ? 'Ouverte' : 'Fermée' }}
                                    </span>
                                    @if($task->due_date && $task->due_date < now() && $task->status == 'open')
                                        <span class="status-badge status-urgent">En retard</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Métadonnées -->
                        <div class="p-6 border-b border-neutral-200">
                            <div class="flex items-center justify-between text-sm text-neutral-500">
                                <div class="flex items-center space-x-4">
                                    @if($task->team)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            {{ $task->team->name }}
                                        </div>
                                    @endif
                                    
                                    @if($task->due_date)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $task->due_date->format('d/m/Y') }}
                                        </div>
                                    @endif
                                    
                                    @if($task->file)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                            </svg>
                                            <a href="{{ asset('storage/' . $task->file) }}" target="_blank" class="text-blue-600 hover:text-blue-700">
                                                Fichier joint
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    {{ $task->comments->count() }} commentaires
                                </div>
                            </div>
                        </div>

                        <!-- Commentaires -->
                        @if($task->comments->count() > 0)
                            <div class="p-6 border-b border-neutral-200">
                                <h4 class="text-sm font-medium text-neutral-900 mb-3">Commentaires récents</h4>
                                <div class="space-y-3 max-h-32 overflow-y-auto">
                                    @foreach($task->comments->take(2) as $comment)
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0">
                                                <div class="w-6 h-6 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                                    <span class="text-xs font-medium text-white">
                                                        {{ substr($comment->user->name, 0, 1) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between">
                                                    <p class="text-sm font-medium text-neutral-900">{{ $comment->user->name }}</p>
                                                    <div class="flex items-center space-x-2">
                                                        @can('update', $comment)
                                                            <a href="{{ route('comments.edit', $comment->id) }}" class="text-xs text-blue-600 hover:text-blue-700">
                                                                Modifier
                                                            </a>
                                                        @endcan
                                                        @can('delete', $comment)
                                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-xs text-red-600 hover:text-red-700"
                                                                        onclick="return confirm('Supprimer ce commentaire ?')">
                                                                    Supprimer
                                                                </button>
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </div>
                                                <p class="text-sm text-neutral-600 mt-1">{{ $comment->body }}</p>
                                                <p class="text-xs text-neutral-400 mt-1">{{ $comment->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Formulaire de commentaire -->
                        <div class="p-6 border-b border-neutral-200">
                            <form action="{{ route('comments.store', $task) }}" method="POST" class="space-y-3">
                                @csrf
                                <textarea name="body" rows="2" class="form-textarea" placeholder="Ajouter un commentaire..."></textarea>
                                <button type="submit" class="btn-primary btn-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Commenter
                                </button>
                            </form>
                        </div>

                        <!-- Actions -->
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div class="text-xs text-neutral-500">
                                    Créée {{ $task->created_at->diffForHumans() }}
                                </div>
                                <div class="flex items-center space-x-2">
                                    @can('update', $task)
                                        <a href="{{ route('tasks.edit', $task) }}" class="btn-ghost btn-sm">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Modifier
                                        </a>
                                    @endcan
                                    @can('delete', $task)
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-ghost btn-sm text-red-600 hover:text-red-700 hover:bg-red-50"
                                                    onclick="return confirm('Supprimer cette tâche ?')">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Supprimer
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- État vide -->
            <div class="modern-card">
                <div class="text-center py-16">
                    <svg class="mx-auto h-16 w-16 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-neutral-900">Aucune tâche trouvée</h3>
                    <p class="mt-2 text-sm text-neutral-500">
                        @if(request()->hasAny(['q', 'status']))
                            Aucune tâche ne correspond à vos critères de recherche.
                        @else
                            Commencez par créer votre première tâche.
                        @endif
                    </p>
                    <div class="mt-6 flex justify-center space-x-3">
                        @if(request()->hasAny(['q', 'status']))
                            <a href="{{ route('tasks.index') }}" class="btn-secondary">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Voir toutes les tâches
                            </a>
                        @endif
                        <a href="{{ route('tasks.create') }}" class="btn-primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Créer une tâche
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Styles supplémentaires -->
    <style>
        .btn-sm {
            @apply px-3 py-1.5 text-sm;
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-app-layout>