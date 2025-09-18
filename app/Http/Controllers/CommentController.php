<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 


class CommentController extends Controller
{
     use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    
     /* Store a newly created resource in storage.*/
    public function store(Request $request, Task $task)
{
    $request->validate([
        'body' => 'required|string|max:1000',
    ]);

    Comment::create([
        'task_id' => $task->id,
        'user_id' => auth()->id(),
        'body' => $request->body,
    ]);

    return redirect()->back()->with('success', 'Commentaire ajouté !');
}

    
    /* Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Formulaire pour modifier un commentaire
    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment); // Vérifie que c'est l'auteur
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment->update([
            'body' => $request->body,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Commentaire mis à jour !');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return redirect()->back()->with('success', 'Commentaire supprimé !');
    }
}
