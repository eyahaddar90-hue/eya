<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any comments.
     */
    public function viewAny(User $user): bool
    {
        return true; // Tout utilisateur peut voir les commentaires
    }

    /**
     * Determine whether the user can view a specific comment.
     */
    public function view(User $user, Comment $comment): bool
    {
        return true; // Tout utilisateur peut voir un commentaire
    }

    /**
     * Determine whether the user can create comments.
     */
    public function create(User $user): bool
    {
        return true; // Tout utilisateur peut créer un commentaire
    }

    /**
     * Determine whether the user can update the comment.
     */
    public function update(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id; // Seul l'auteur peut modifier
    }

    /**
     * Determine whether the user can delete the comment.
     */
    public function delete(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id; // Seul l'auteur peut supprimer
    }

    /**
     * Determine whether the user can restore the comment.
     */
    public function restore(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id;
    }

    /**
     * Determine whether the user can permanently delete the comment.
     */
    public function forceDelete(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id;
    }
}
