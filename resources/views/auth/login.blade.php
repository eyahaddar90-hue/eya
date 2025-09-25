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
                <h2 class="text-3xl font-bold text-neutral-900">Bienvenue sur TaskFlow</h2>
                <p class="mt-2 text-sm text-neutral-600">Connectez-vous à votre compte pour continuer</p>
            </div>

            <!-- Messages de statut -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Formulaire de connexion -->
            <div class="modern-card">
                <div class="p-8">
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

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
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
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
                                <input id="password" type="password" name="password" required autocomplete="current-password"
                                       class="form-input pl-10 {{ $errors->get('password') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                                       placeholder="••••••••">
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Se souvenir de moi -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" type="checkbox" name="remember" 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-neutral-300 rounded">
                                <label for="remember_me" class="ml-2 block text-sm text-neutral-900">
                                    Se souvenir de moi
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="text-sm">
                                    <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-500">
                                        Mot de passe oublié ?
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Bouton de connexion -->
                        <div>
                            <button type="submit" class="w-full btn-primary justify-center py-3">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Se connecter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Lien d'inscription -->
            <div class="text-center">
                <p class="text-sm text-neutral-600">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500 ml-1">
                        Créer un compte
                    </a>
                </p>
            </div>

            <!-- Fonctionnalités -->
            <div class="mt-8 grid grid-cols-1 gap-4">
                <div class="flex items-center p-4 bg-white rounded-lg border border-neutral-200">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-neutral-900">Gestion des tâches</p>
                        <p class="text-xs text-neutral-500">Organisez et suivez vos projets</p>
                    </div>
                </div>

                <div class="flex items-center p-4 bg-white rounded-lg border border-neutral-200">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-neutral-900">Collaboration en équipe</p>
                        <p class="text-xs text-neutral-500">Travaillez ensemble efficacement</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>