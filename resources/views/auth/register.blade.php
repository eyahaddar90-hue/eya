<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-purple-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo et titre -->
            <div class="text-center">
                <div class="mx-auto w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-neutral-900">Créer un compte</h2>
                <p class="mt-2 text-sm text-neutral-600">Rejoignez TaskFlow et organisez vos projets</p>
            </div>

            <!-- Formulaire d'inscription -->
            <div class="modern-card">
                <div class="p-8">
                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <!-- Nom -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-neutral-900 mb-2">
                                Nom complet
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                                       class="form-input pl-10 {{ $errors->get('name') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                                       placeholder="Votre nom complet">
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-neutral-900 mb-2">
                                Adresse email
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                                       class="form-input pl-10 {{ $errors->get('email') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                                       placeholder="votre@email.com">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Mot de passe -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-neutral-900 mb-2">
                                Mot de passe
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input id="password" type="password" name="password" required autocomplete="new-password"
                                       class="form-input pl-10 {{ $errors->get('password') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                                       placeholder="••••••••">
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirmation du mot de passe -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-neutral-900 mb-2">
                                Confirmer le mot de passe
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                       class="form-input pl-10 {{ $errors->get('password_confirmation') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                                       placeholder="••••••••">
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Bouton d'inscription -->
                        <div>
                            <button type="submit" class="w-full btn-primary justify-center py-3">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                Créer mon compte
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Lien de connexion -->
            <div class="text-center">
                <p class="text-sm text-neutral-600">
                    Déjà un compte ?
                    <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500 ml-1">
                        Se connecter
                    </a>
                </p>
            </div>

            <!-- Avantages -->
            <div class="mt-8 space-y-3">
                <div class="flex items-center text-sm text-neutral-600">
                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Interface moderne et intuitive
                </div>
                <div class="flex items-center text-sm text-neutral-600">
                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Collaboration en temps réel
                </div>
                <div class="flex items-center text-sm text-neutral-600">
                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Suivi avancé des projets
                </div>
                <div class="flex items-center text-sm text-neutral-600">
                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Gratuit pour commencer
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>