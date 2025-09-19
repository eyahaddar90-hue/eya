<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    use AuthorizesRequests;

    // Affiche la liste des tâches
    public function index(\Illuminate\Http\Request $request)
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

    // Formulaire pour créer une tâche
    public function create()
    {
        $teams = Team::all();
        return view('tasks.create', compact('teams'));
    }

    // Stocke une nouvelle tâche
    public function store(StoreTaskRequest $request)
    {
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('tasks', 'public');
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

    // Formulaire pour éditer une tâche
    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        $teams = Team::all();
        return view('tasks.edit', compact('task', 'teams'));
    }

    // Met à jour une tâche
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $filePath = $task->file;
        if ($request->hasFile('file')) {
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
        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée !');
    }
}
