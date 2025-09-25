<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="page-title">Tableau de bord</h1>
                <p class="page-subtitle">Aperçu de vos tâches et projets</p>
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

    <div class="p-6 space-y-8">
        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="modern-card p-6 animate-fade-in">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-neutral-600">Total des tâches</p>
                        <p class="text-2xl font-bold text-neutral-900">{{ auth()->user()->tasks()->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="modern-card p-6 animate-fade-in" style="animation-delay: 0.1s">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-neutral-600">Tâches ouvertes</p>
                        <p class="text-2xl font-bold text-neutral-900">{{ auth()->user()->tasks()->where('status', 'open')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="modern-card p-6 animate-fade-in" style="animation-delay: 0.2s">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-neutral-600">Équipes</p>
                        <p class="text-2xl font-bold text-neutral-900">{{ auth()->user()->teams()->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="modern-card p-6 animate-fade-in" style="animation-delay: 0.3s">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-neutral-600">En retard</p>
                        <p class="text-2xl font-bold text-neutral-900">
                            {{ auth()->user()->tasks()->where('due_date', '<', now())->where('status', 'open')->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Tâches récentes -->
            <div class="lg:col-span-2">
                <div class="modern-card">
                    <div class="p-6 border-b border-neutral-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-neutral-900">Tâches récentes</h2>
                            <a href="{{ route('tasks.index') }}" class="btn-ghost text-sm">
                                Voir tout
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="p-6">
                        @php
                            $recentTasks = auth()->user()->tasks()->with('team')->latest()->take(5)->get();
                        @endphp
                        
                        @if($recentTasks->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentTasks as $task)
                                    <div class="flex items-center p-4 bg-neutral-50 rounded-lg hover:bg-neutral-100 transition-colors">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <h3 class="text-sm font-medium text-neutral-900">{{ $task->title }}</h3>
                                            <p class="text-sm text-neutral-500">{{ $task->team->name ?? 'Aucune équipe' }}</p>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="status-badge {{ $task->status == 'open' ? 'status-open' : 'status-closed' }}">
                                                {{ $task->status == 'open' ? 'Ouverte' : 'Fermée' }}
                                            </span>
                                            @if($task->due_date && $task->due_date < now() && $task->status == 'open')
                                                <span class="status-badge status-urgent">En retard</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-neutral-900">Aucune tâche</h3>
                                <p class="mt-1 text-sm text-neutral-500">Commencez par créer votre première tâche.</p>
                                <div class="mt-6">
                                    <a href="{{ route('tasks.create') }}" class="btn-primary">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        Créer une tâche
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar droite -->
            <div class="space-y-6">
                <!-- Activité récente -->
                <div class="modern-card">
                    <div class="p-6 border-b border-neutral-200">
                        <h2 class="text-lg font-semibold text-neutral-900">Activité récente</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @php
                                $recentComments = auth()->user()->comments()->with('task')->latest()->take(3)->get();
                            @endphp
                            
                            @if($recentComments->count() > 0)
                                @foreach($recentComments as $comment)
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-blue-600 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm text-neutral-900">
                                                Commentaire sur <span class="font-medium">{{ $comment->task->title }}</span>
                                            </p>
                                            <p class="text-xs text-neutral-500">{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-sm text-neutral-500 text-center py-4">Aucune activité récente</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Équipes -->
                <div class="modern-card">
                    <div class="p-6 border-b border-neutral-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-neutral-900">Mes équipes</h2>
                            <a href="{{ route('teams.index') }}" class="btn-ghost text-sm">Voir tout</a>
                        </div>
                    </div>
                    <div class="p-6">
                        @php
                            $userTeams = auth()->user()->teams()->take(3)->get();
                        @endphp
                        
                        @if($userTeams->count() > 0)
                            <div class="space-y-3">
                                @foreach($userTeams as $team)
                                    <div class="flex items-center p-3 bg-neutral-50 rounded-lg">
                                        <div class="flex-shrink-0">
                                            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                                <span class="text-xs font-medium text-white">
                                                    {{ substr($team->name, 0, 1) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <p class="text-sm font-medium text-neutral-900">{{ $team->name }}</p>
                                            <p class="text-xs text-neutral-500">{{ $team->users->count() }} membres</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <p class="text-sm text-neutral-500">Aucune équipe</p>
                                <a href="{{ route('teams.create') }}" class="text-sm text-blue-600 hover:text-blue-700 mt-2 inline-block">
                                    Créer une équipe
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>