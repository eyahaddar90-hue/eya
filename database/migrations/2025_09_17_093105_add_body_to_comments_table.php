<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   
   public function up(): void
{
    if (!Schema::hasColumn('comments', 'body')) {
        Schema::table('comments', function (Blueprint $table) {
            $table->text('body')->after('id'); // ou après la colonne que tu veux
        });
    }
}

public function down(): void
{
    Schema::table('comments', function (Blueprint $table) {
        $table->dropColumn('body');
    });
}


};
