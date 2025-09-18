<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained()->onDelete('cascade'); // La tâche
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // L'utilisateur qui commente
            $table->text('body'); // Contenu du commentaire
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Supprimer la table entière plutôt qu'une colonne (plus sûr sur SQLite)
        Schema::dropIfExists('comments');
    }
};
