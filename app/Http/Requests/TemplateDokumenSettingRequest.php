<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemplateDokumenSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul_seksi' => ['required', 'string', 'max:255'],
            'deskripsi_seksi' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul_seksi.required' => 'Judul seksi wajib diisi.',
        ];
    }
}
