<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="page-title">Modifier la tâche</h1>
                <p class="page-subtitle">{{ $task->title }}</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('tasks.index') }}" class="btn-secondary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="max-w-2xl mx-auto">
            <div class="modern-card">
                <div class="p-8">
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <!-- Titre -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-neutral-900 mb-2">
                                Titre de la tâche *
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}"
                                   class="form-input {{ $errors->has('title') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                                   placeholder="Entrez le titre de la tâche">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-neutral-900 mb-2">
                                Description
                            </label>
                            <textarea name="description" id="description" rows="4"
                                      class="form-textarea {{ $errors->has('description') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                                      placeholder="Décrivez la tâche en détail...">{{ old('description', $task->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date d'échéance et Équipe -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="due_date" class="block text-sm font-medium text-neutral-900 mb-2">
                                    Date d'échéance *
                                </label>
                                <input type="date" name="due_date" id="due_date"
                                       value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
                                       class="form-input {{ $errors->has('due_date') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}">
                                @error('due_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="team_id" class="block text-sm font-medium text-neutral-900 mb-2">
                                    Équipe *
                                </label>
                                <select name="team_id" id="team_id"
                                        class="form-select {{ $errors->has('team_id') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}">
                                    <option value="">Sélectionnez une équipe</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" {{ old('team_id', $task->team_id) == $team->id ? 'selected' : '' }}>
                                            {{ $team->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('team_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Statut et Fichier -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="status" class="block text-sm font-medium text-neutral-900 mb-2">
                                    Statut *
                                </label>
                                <select name="status" id="status"
                                        class="form-select {{ $errors->has('status') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}">
                                    <option value="open" {{ old('status', $task->status) == 'open' ? 'selected' : '' }}>Ouverte</option>
                                    <option value="closed" {{ old('status', $task->status) == 'closed' ? 'selected' : '' }}>Fermée</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="file" class="block text-sm font-medium text-neutral-900 mb-2">
                                    Fichier joint
                                </label>
                                <div class="space-y-2">
                                    <input type="file" name="file" id="file"
                                           class="form-input {{ $errors->has('file') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}">
                                    @if($task->file)
                                        <div class="flex items-center p-3 bg-neutral-50 rounded-lg">
                                            <svg class="w-5 h-5 text-neutral-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                            </svg>
                                            <span class="text-sm text-neutral-600 flex-1">Fichier actuel</span>
                                            <a href="{{ asset('storage/' . $task->file) }}" target="_blank" 
                                               class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                                                Télécharger
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                @error('file')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-neutral-500">Formats acceptés: PDF, DOC, DOCX, JPG, PNG (max 2MB)</p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-neutral-200">
                            <a href="{{ route('tasks.index') }}" class="btn-secondary">
                                Annuler
                            </a>
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

            <!-- Historique des modifications -->
            <div class="mt-8 modern-card">
                <div class="p-6">
                    <h3 class="text-sm font-medium text-neutral-900 mb-4">📝 Informations sur la tâche</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-neutral-500">Créée le:</span>
                            <span class="text-neutral-900 ml-2">{{ $task->created_at->format('d/m/Y à H:i') }}</span>
                        </div>
                        <div>
                            <span class="text-neutral-500">Dernière modification:</span>
                            <span class="text-neutral-900 ml-2">{{ $task->updated_at->format('d/m/Y à H:i') }}</span>
                        </div>
                        <div>
                            <span class="text-neutral-500">Créée par:</span>
                            <span class="text-neutral-900 ml-2">{{ $task->user->name ?? 'Utilisateur supprimé' }}</span>
                        </div>
                        <div>
                            <span class="text-neutral-500">Commentaires:</span>
                            <span class="text-neutral-900 ml-2">{{ $task->comments->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script pour améliorer l'UX -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Validation côté client
            const form = document.querySelector('form');
            const titleInput = document.getElementById('title');
            const dueDateInput = document.getElementById('due_date');
            const teamSelect = document.getElementById('team_id');
            
            form.addEventListener('submit', function(e) {
                let hasErrors = false;
                
                // Validation du titre
                if (!titleInput.value.trim()) {
                    showFieldError(titleInput, 'Le titre est requis');
                    hasErrors = true;
                }
                
                // Validation de l'équipe
                if (!teamSelect.value) {
                    showFieldError(teamSelect, 'Veuillez sélectionner une équipe');
                    hasErrors = true;
                }
                
                if (hasErrors) {
                    e.preventDefault();
                }
            });
            
            function showFieldError(field, message) {
                // Supprimer les erreurs existantes
                const existingError = field.parentNode.querySelector('.field-error');
                if (existingError) {
                    existingError.remove();
                }
                
                // Ajouter la classe d'erreur
                field.classList.add('border-red-300', 'focus:ring-red-500', 'focus:border-red-500');
                
                // Ajouter le message d'erreur
                const errorElement = document.createElement('p');
                errorElement.className = 'mt-1 text-sm text-red-600 field-error';
                errorElement.textContent = message;
                field.parentNode.appendChild(errorElement);
            }
            
            // Supprimer les erreurs lors de la saisie
            [titleInput, dueDateInput, teamSelect].forEach(field => {
                field.addEventListener('input', function() {
                    this.classList.remove('border-red-300', 'focus:ring-red-500', 'focus:border-red-500');
                    const error = this.parentNode.querySelector('.field-error');
                    if (error) {
                        error.remove();
                    }
                });
            });
        });
    </script>
</x-app-layout>