<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ou mettre une logique pour autoriser uniquement certains utilisateurs
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255|unique:tasks,title',
            'description' => 'required|string|max:1000',
            'due_date'    => 'required|date|after:today',
            'team_id'     => 'required|exists:teams,id',
            'file'        => 'nullable|file|max:2048',
            'status'      => 'required|in:open,closed',
        ];
    }
}
