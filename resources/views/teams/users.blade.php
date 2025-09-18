<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Utilisateurs de l\'équipe') }}: {{ $team->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white shadow sm:rounded-lg p-6">
            @if($users->isEmpty())
                <p>Aucun utilisateur pour cette équipe.</p>
            @else
                <ul>
                    @foreach($users as $user)
                        <li class="px-2 py-1 bg-gray-100 rounded mb-1">{{ $user->name }} ({{ $user->email }})</li>
                    @endforeach
                </ul>
            @endif

            <a href="{{ route('teams.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                Retour aux équipes
            </a>
        </div>
    </div>
</x-app-layout>
