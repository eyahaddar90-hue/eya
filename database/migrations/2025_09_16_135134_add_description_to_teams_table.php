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
    if (!Schema::hasColumn('teams', 'description')) {
        Schema::table('teams', function (Blueprint $table) {
            $table->text('description')->after('name'); // ou après la colonne que tu veux
        });
    }
}


public function down()
{
    Schema::table('teams', function (Blueprint $table) {
        $table->dropColumn('description');
    });
}

};
