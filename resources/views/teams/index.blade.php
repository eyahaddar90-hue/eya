<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="page-title">Équipes</h1>
                <p class="page-subtitle">Gérez vos équipes et collaborateurs</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('teams.create') }}" class="btn-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nouvelle équipe
                </a>
            </div>
        </div>
    </x-slot>

    <div class="p-6">
        @if($teams->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($teams as $team)
                    <div class="modern-card animate-fade-in" style="animation-delay: {{ $loop->index * 0.1 }}s">
                        <!-- En-tête de l'équipe -->
                        <div class="p-6 border-b border-neutral-200">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center">
                                        <span class="text-lg font-bold text-white">
                                            {{ substr($team->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-semibold text-neutral-900">{{ $team->name }}</h3>
                                        <p class="text-sm text-neutral-500">{{ $team->users->count() }} membres</p>
                                    </div>
                                </div>
                                
                                <!-- Menu d'actions -->
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="p-2 text-neutral-400 hover:text-neutral-600 rounded-lg hover:bg-neutral-100">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                        </svg>
                                    </button>
                                    
                                    <div x-show="open" 
                                         @click.away="open = false"
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="transform opacity-0 scale-95"
                                         x-transition:enter-end="transform opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="transform opacity-100 scale-100"
                                         x-transition:leave-end="transform opacity-0 scale-95"
                                         class="absolute right-0 top-full mt-2 w-48 bg-white rounded-lg shadow-lg border border-neutral-200 py-1 z-10">
                                        <a href="{{ route('teams.edit', $team->id) }}" class="block px-4 py-2 text-sm text-neutral-700 hover:bg-neutral-50">
                                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Modifier
                                        </a>
                                        <form action="{{ route('teams.destroy', $team->id) }}" method="POST" class="block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50"
                                                    onclick="return confirm('Supprimer cette équipe ?')">
                                                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        @if($team->description)
                            <div class="p-6 border-b border-neutral-200">
                                <p class="text-sm text-neutral-600">{{ $team->description }}</p>
                            </div>
                        @endif

                        <!-- Membres de l'équipe -->
                        <div class="p-6 border-b border-neutral-200">
                            <h4 class="text-sm font-medium text-neutral-900 mb-3">Membres de l'équipe</h4>
                            @if($team->users->count() > 0)
                                <div class="space-y-2">
                                    @foreach($team->users->take(3) as $user)
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                                <span class="text-xs font-medium text-white">
                                                    {{ substr($user->name, 0, 1) }}
                                                </span>
                                            </div>
                                            <span class="ml-2 text-sm text-neutral-700">{{ $user->name }}</span>
                                        </div>
                                    @endforeach
                                    @if($team->users->count() > 3)
                                        <div class="text-xs text-neutral-500 mt-2">
                                            +{{ $team->users->count() - 3 }} autres membres
                                        </div>
                                    @endif
                                </div>
                            @else
                                <p class="text-sm text-neutral-500">Aucun membre</p>
                            @endif
                        </div>

                        <!-- Statistiques -->
                        <div class="p-6 border-b border-neutral-200">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-neutral-900">{{ $team->tasks->count() }}</div>
                                    <div class="text-xs text-neutral-500">Tâches</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-green-600">{{ $team->tasks->where('status', 'closed')->count() }}</div>
                                    <div class="text-xs text-neutral-500">Terminées</div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="p-6">
                            <div class="flex items-center justify-between text-xs text-neutral-500">
                                <span>Créée {{ $team->created_at->diffForHumans() }}</span>
                                <a href="{{ route('teams.edit', $team->id) }}" class="btn-ghost btn-sm">
                                    Gérer
                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-neutral-900">Aucune équipe</h3>
                    <p class="mt-2 text-sm text-neutral-500">Commencez par créer votre première équipe pour organiser vos projets.</p>
                    <div class="mt-6">
                        <a href="{{ route('teams.create') }}" class="btn-primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Créer une équipe
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Conseils -->
        @if($teams->count() > 0)
            <div class="mt-8 modern-card">
                <div class="p-6">
                    <h3 class="text-sm font-medium text-neutral-900 mb-3">💡 Conseils pour gérer vos équipes</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-neutral-600">
                        <div class="flex items-start">
                            <svg class="w-4 h-4 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Invitez des membres pour collaborer efficacement
                        </div>
                        <div class="flex items-start">
                            <svg class="w-4 h-4 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Organisez vos équipes par projet ou département
                        </div>
                        <div class="flex items-start">
                            <svg class="w-4 h-4 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Utilisez des descriptions claires pour chaque équipe
                        </div>
                        <div class="flex items-start">
                            <svg class="w-4 h-4 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Suivez les statistiques pour mesurer la productivité
                        </div>
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
    </style>
</x-app-layout>