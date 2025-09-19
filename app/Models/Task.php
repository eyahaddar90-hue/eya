<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

 protected $fillable = ['title', 'description', 'due_date', 'team_id', 'status', 'user_id', 'file'];


    // Une tâche appartient à une équipe
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    // Une tâche appartient à un utilisateur (assigné à)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Une tâche peut avoir plusieurs commentaires
   public function comments()
{
    return $this->hasMany(Comment::class)->latest();
}
}
