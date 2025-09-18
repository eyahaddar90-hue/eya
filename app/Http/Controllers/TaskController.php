<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;


class TaskController extends Controller
{
    use AuthorizesRequests; 

    public function index(Request $request)
{
    $user = Auth::user();

    $query = $user->tasks()->latest();

    // Recherche par mot-clé
    if ($request->filled('q')) {
        $q = $request->q;
        $query->where(function ($sub) use ($q) {
            $sub->where('title', 'like', "%{$q}%")
                ->orWhere('description', 'like', "%{$q}%");
        });
    }

    // Filtrage par statut
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $tasks = $query->get();

    return view('tasks.index', compact('tasks'));
}


    // Affiche le formulaire pour créer une tâche
    public function create()
    {
        $teams = Team::all(); // Pour le select des équipes
        return view('tasks.create', compact('teams'));
    }

    // Stocke une nouvelle tâche
    public function store(Request $request)
{
    $request->validate([
        'title'       => 'required|string|max:255|unique:tasks,title',
        'description' => 'required|string|max:1000',
        'due_date'    => 'required|date|after:today',
        'team_id'     => 'required|exists:teams,id',
        'file'        => 'nullable|file|max:2048', // 2 Mo max
        'status'      => 'required|in:open,closed',
    ]);

    $filePath = null;
    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('tasks', 'public'); // stockage dans storage/app/public/tasks
    }

    Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'team_id' => $request->team_id,
        'user_id' => auth()->id(),
        'file' => $filePath,
            'status' => $request->status,


    ]);

    return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès !');
}

    // Affiche le formulaire pour éditer une tâche
   public function edit(Task $task)
{
    $this->authorize('update', $task); // Vérifie que l'utilisateur peut éditer la tâche

    $teams = \App\Models\Team::all(); // récupère toutes les équipes

    return view('tasks.edit', compact('task', 'teams'));
}


    // Met à jour la tâche
    public function update(Request $request, Task $task)
{
    $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'team_id' => 'nullable|exists:teams,id',
        'file' => 'nullable|file|max:10240',
            'status' =>  'required|in:open,closed',

    ]);

    $filePath = $task->file;
    if ($request->hasFile('file')) {
        // Supprimer l'ancien fichier si existe
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
        $filePath = $request->file('file')->store('tasks', 'public');
    }

    $task->update([
        'title' => $request->title,
        'description' => $request->description,
        'team_id' => $request->team_id,
        'file' => $filePath,
            'status' => $request->status,

    ]);

    return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour !');
}

    // Supprime une tâche
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();
        return redirect()->route('tasks.index');
    }
}
