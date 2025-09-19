<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // autorise tous les utilisateurs, tu peux mettre une logique ici
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date|after:today',
            'team_id' => 'required|exists:teams,id',
            'user_id' => 'nullable|exists:users,id',
        ];
    }
}
