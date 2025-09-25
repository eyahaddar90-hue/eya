<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="page-title">Gérer l'équipe</h1>
                <p class="page-subtitle">{{ $team->name }}</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('teams.index') }}" class="btn-secondary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="max-w-4xl mx-auto space-y-8">
            <!-- Informations de l'équipe -->
            <div class="modern-card">
                <div class="p-6 border-b border-neutral-200">
                    <h2 class="text-lg font-semibold text-neutral-900">Informations de l'équipe</h2>
                </div>
                <div class="p-6">
                    <form action="{{ route('teams.update', $team->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nom de l'équipe -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-neutral-900 mb-2">
                                    Nom de l'équipe *
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name', $team->name) }}"
                                       class="form-input {{ $errors->has('name') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Statistiques -->
                            <div class="bg-neutral-50 rounded-lg p-4">
                                <h3 class="text-sm font-medium text-neutral-900 mb-3">Statistiques</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-neutral-900">{{ $team->users->count() }}</div>
                                        <div class="text-xs text-neutral-500">Membres</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-blue-600">{{ $team->tasks->count() }}</div>
                                        <div class="text-xs text-neutral-500">Tâches</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-neutral-900 mb-2">
                                Description
                            </label>
                            <textarea name="description" id="description" rows="3"
                                      class="form-textarea {{ $errors->has('description') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                                      placeholder="Décrivez le rôle et les objectifs de cette équipe...">{{ old('description', $team->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end space-x-4 pt-4 border-t border-neutral-200">
                            <button type="submit" class="btn-primary">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Membres actuels -->
            <div class="modern-card">
                <div class="p-6 border-b border-neutral-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-neutral-900">Membres de l'équipe</h2>
                        <span class="text-sm text-neutral-500">{{ $team->users->count() }} membres</span>
                    </div>
                </div>
                <div class="p-6">
                    @if($team->users->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($team->users as $user)
                                <div class="flex items-center p-4 bg-neutral-50 rounded-lg">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                            <span class="text-sm font-medium text-white">
                                                {{ substr($user->name, 0, 1) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="text-sm font-medium text-neutral-900">{{ $user->name }}</p>
                                        <p class="text-xs text-neutral-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-neutral-900">Aucun membre</h3>
                            <p class="mt-1 text-sm text-neutral-500">Commencez par inviter des utilisateurs à rejoindre cette équipe.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Inviter des utilisateurs -->
            @if($users->count() > 0)
                <div class="modern-card">
                    <div class="p-6 border-b border-neutral-200">
                        <h2 class="text-lg font-semibold text-neutral-900">Inviter de nouveaux membres</h2>
                        <p class="text-sm text-neutral-500 mt-1">Sélectionnez les utilisateurs à ajouter à cette équipe</p>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('teams.invite', $team->id) }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($users as $user)
                                        <label class="flex items-center p-4 border border-neutral-200 rounded-lg hover:bg-neutral-50 cursor-pointer transition-colors">
                                            <input type="checkbox" name="users[]" value="{{ $user->id }}" 
                                                   class="rounded border-neutral-300 text-blue-600 focus:ring-blue-500">
                                            <div class="ml-3 flex items-center">
                                                <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-blue-600 rounded-full flex items-center justify-center">
                                                    <span class="text-xs font-medium text-white">
                                                        {{ substr($user->name, 0, 1) }}
                                                    </span>
                                                </div>
                                                <div class="ml-2">
                                                    <p class="text-sm font-medium text-neutral-900">{{ $user->name }}</p>
                                                    <p class="text-xs text-neutral-500">{{ $user->email }}</p>
                                                </div>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                
                                <div class="flex items-center justify-end pt-4 border-t border-neutral-200">
                                    <button type="submit" class="btn-primary">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Inviter les utilisateurs sélectionnés
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="modern-card">
                    <div class="p-6 text-center">
                        <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-neutral-900">Tous les utilisateurs sont déjà membres</h3>
                        <p class="mt-1 text-sm text-neutral-500">Il n'y a plus d'utilisateurs disponibles à inviter dans cette équipe.</p>
                    </div>
                </div>
            @endif

            <!-- Tâches de l'équipe -->
            @if($team->tasks->count() > 0)
                <div class="modern-card">
                    <div class="p-6 border-b border-neutral-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-neutral-900">Tâches de l'équipe</h2>
                            <span class="text-sm text-neutral-500">{{ $team->tasks->count() }} tâches</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            @foreach($team->tasks->take(5) as $task)
                                <div class="flex items-center justify-between p-3 bg-neutral-50 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-neutral-900">{{ $task->title }}</p>
                                            <p class="text-xs text-neutral-500">{{ $task->user->name ?? 'Non assignée' }}</p>
                                        </div>
                                    </div>
                                    <span class="status-badge {{ $task->status == 'open' ? 'status-open' : 'status-closed' }}">
                                        {{ $task->status == 'open' ? 'Ouverte' : 'Fermée' }}
                                    </span>
                                </div>
                            @endforeach
                            @if($team->tasks->count() > 5)
                                <div class="text-center pt-3">
                                    <a href="{{ route('tasks.index') }}?team={{ $team->id }}" class="text-sm text-blue-600 hover:text-blue-700">
                                        Voir toutes les tâches de l'équipe
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Script pour améliorer l'UX -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sélection multiple des utilisateurs
            const checkboxes = document.querySelectorAll('input[name="users[]"]');
            const submitButton = document.querySelector('button[type="submit"]');
            
            function updateSubmitButton() {
                const checkedBoxes = document.querySelectorAll('input[name="users[]"]:checked');
                if (submitButton) {
                    if (checkedBoxes.length > 0) {
                        submitButton.textContent = `Inviter ${checkedBoxes.length} utilisateur${checkedBoxes.length > 1 ? 's' : ''}`;
                        submitButton.disabled = false;
                    } else {
                        submitButton.innerHTML = `
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Sélectionnez des utilisateurs
                        `;
                        submitButton.disabled = true;
                    }
                }
            }
            
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSubmitButton);
            });
            
            // Initialiser l'état du bouton
            updateSubmitButton();
        });
    </script>
</x-app-layout>