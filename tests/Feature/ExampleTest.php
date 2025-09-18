<?php

use App\Models\User;

it('returns a successful response', function () {
    // Crée un utilisateur fictif
    $user = User::factory()->create();

    // Simule que l'utilisateur est connecté
    $response = $this->actingAs($user)->get('/');

    // Vérifie que la réponse est 200 OK
    $response->assertStatus(200);
});
