<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ajouter la logique d'autorisation si nécessaire
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'team_id' => 'nullable|exists:teams,id',
            'file' => 'nullable|file|max:10240',
            'status' => 'required|in:open,closed',
        ];
    }
}

