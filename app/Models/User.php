<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
 protected $fillable = [
        'name',
        'email',
        'password',
    ];
    // Un utilisateur peut avoir plusieurs tâches assignées
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Un utilisateur peut faire plusieurs commentaires
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relation avec les équipes (plusieurs équipes possibles)
public function teams()
{
    return $this->belongsToMany(Team::class , 'team_user');
}

}
