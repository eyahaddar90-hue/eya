<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Tâches -->
                <div class="bg-white overflow-hidden shadow rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Gérer les Tâches</h3>
                    <p class="text-gray-500 mb-6">Créez, éditez et suivez vos tâches facilement.</p>
                    <a href="{{ route('tasks.index') }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Voir les Tâches
                    </a>
                </div>

                <!-- Équipes -->
                <div class="bg-white overflow-hidden shadow rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Gérer les Équipes</h3>
                    <p class="text-gray-500 mb-6">Organisez vos équipes et membres du projet.</p>
                    <a href="{{ route('teams.index') }}"
                       class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                        Voir les Équipes
                    </a>
                </div>

                <!-- Profil -->
                <div class="bg-white overflow-hidden shadow rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Mon Profil</h3>
                    <p class="text-gray-500 mb-6">Mettez à jour vos informations personnelles.</p>
                    <a href="{{ route('profile.edit') }}"
                       class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">
                        Voir le Profil
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
