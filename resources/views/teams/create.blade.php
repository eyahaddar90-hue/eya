<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="page-title">Créer une équipe</h1>
                <p class="page-subtitle">Organisez votre travail en équipe</p>
            </div>
            <a href="{{ route('teams.index') }}" class="btn-secondary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="max-w-2xl mx-auto">
            <div class="modern-card">
                <div class="p-8">
                    <form action="{{ route('teams.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Nom de l'équipe -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-neutral-900 mb-2">
                                Nom de l'équipe *
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                   class="form-input {{ $errors->has('name') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                                   placeholder="Ex: Équipe Marketing, Développement Web...">
                            @error('name')
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
                                      placeholder="Décrivez le rôle et les objectifs de cette équipe...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-neutral-500">Une description claire aide les membres à comprendre les objectifs de l'équipe</p>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-neutral-200">
                            <a href="{{ route('teams.index') }}" class="btn-secondary">
                                Annuler
                            </a>
                            <button type="submit" class="btn-primary">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Créer l'équipe
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Étapes suivantes -->
            <div class="mt-8 modern-card">
                <div class="p-6">
                    <h3 class="text-sm font-medium text-neutral-900 mb-4">🚀 Prochaines étapes</h3>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-xs font-medium text-blue-600">1</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-neutral-900">Créer votre équipe</p>
                                <p class="text-xs text-neutral-500">Donnez un nom et une description à votre équipe</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-6 h-6 bg-neutral-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-xs font-medium text-neutral-400">2</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-neutral-900">Inviter des membres</p>
                                <p class="text-xs text-neutral-500">Ajoutez des collaborateurs à votre équipe</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-6 h-6 bg-neutral-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-xs font-medium text-neutral-400">3</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-neutral-900">Créer des tâches</p>
                                <p class="text-xs text-neutral-500">Commencez à organiser le travail de votre équipe</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Conseils -->
            <div class="mt-8 modern-card">
                <div class="p-6">
                    <h3 class="text-sm font-medium text-neutral-900 mb-3">💡 Conseils pour nommer votre équipe</h3>
                    <ul class="text-sm text-neutral-600 space-y-2">
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Utilisez un nom descriptif et facile à retenir
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Reflétez la fonction ou le projet de l'équipe
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Évitez les noms trop génériques comme "Équipe 1"
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Gardez le nom court et professionnel
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Script pour améliorer l'UX -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-focus sur le nom
            document.getElementById('name').focus();
            
            // Validation côté client
            const form = document.querySelector('form');
            const nameInput = document.getElementById('name');
            
            form.addEventListener('submit', function(e) {
                if (!nameInput.value.trim()) {
                    e.preventDefault();
                    showFieldError(nameInput, 'Le nom de l\'équipe est requis');
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
            nameInput.addEventListener('input', function() {
                this.classList.remove('border-red-300', 'focus:ring-red-500', 'focus:border-red-500');
                const error = this.parentNode.querySelector('.field-error');
                if (error) {
                    error.remove();
                }
            });
        });
    </script>
</x-app-layout>