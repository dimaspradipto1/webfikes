<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PmbSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'badge_text' => ['required', 'string', 'max:255'],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'tombol_text_1' => ['required', 'string', 'max:255'],
            'tombol_link_1' => ['required', 'string', 'max:500'],
            'tombol_text_2' => ['nullable', 'string', 'max:255'],
            'tombol_link_2' => ['nullable', 'string', 'max:500'],
            'gelombang_list' => ['nullable', 'array'],
            'gelombang_list.*' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
