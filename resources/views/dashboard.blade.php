<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Bienvenue sur <span class="text-indigo-600">TaskManager</span>
            </h2>
            <p class="text-gray-500 mt-2 text-xl">
                Organisez vos projets en toute simplicité
            </p>
        </div>
    </x-slot>


    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- Section résumé rapide --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-20">
                <div class="bg-white shadow-lg rounded-2xl p-6 text-center hover:shadow-xl transition">
                    <div class="text-blue-600 text-4xl mb-2">📋</div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Gérer les Tâches</h3>
                    <p class="text-gray-500 mb-4">Créez, suivez et terminez vos tâches facilement.</p>
                    <a href="{{ route('tasks.index') }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Accéder
                    </a>
                </div>

                <div class="bg-white shadow-lg rounded-2xl p-6 text-center hover:shadow-xl transition">
                    <div class="text-green-600 text-4xl mb-2">👥</div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Gérer les Équipes</h3>
                    <p class="text-gray-500 mb-4">Organisez vos équipes et attribuez des tâches.</p>
                    <a href="{{ route('teams.index') }}"
                       class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        Accéder
                    </a>
                </div>

                <div class="bg-white shadow-lg rounded-2xl p-6 text-center hover:shadow-xl transition">
                    <div class="text-purple-600 text-4xl mb-2">🧑‍💼</div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Mon Profil</h3>
                    <p class="text-gray-500 mb-4">Modifiez vos informations personnelles.</p>
                    <a href="{{ route('profile.edit') }}"
                       class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                        Accéder
                    </a>
                </div>
            </div>

            {{-- Section motivationnelle (optionnelle) --}}
<div class="bg-gradient-to-r from-indigo-100 to-purple-100 rounded-2xl p-10 text-center text-gray-800 shadow-xl">
    <h3 class="text-2xl font-bold mb-3">Gagnez du temps, atteignez vos objectifs</h3>
    <p class="text-gray-600 mb-6 max-w-xl mx-auto">
        TaskManager vous aide à structurer vos projets et collaborer efficacement avec votre équipe.
    </p>
    <a href="{{ route('tasks.index') }}"
       class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
       Commencer maintenant
    </a>
</div>
{{-- Footer --}}
<footer class="bg-gray-100 mt-20">
    <div class="max-w-7xl mx-auto py-6 px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center text-gray-600">
        <p class="text-sm">&copy; {{ date('Y') }} TaskManager. Tous droits réservés.</p>
    </div>
</footer>



        </div>
    </div>
</x-app-layout>
