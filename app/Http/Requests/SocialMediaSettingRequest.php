<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul_seksi' => ['required', 'string', 'max:255'],
            'subjudul_seksi' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul_seksi.required' => 'Judul Seksi wajib diisi.',
            'subjudul_seksi.required' => 'Subjudul / Kalimat Deskripsi wajib diisi.',
        ];
    }
}
