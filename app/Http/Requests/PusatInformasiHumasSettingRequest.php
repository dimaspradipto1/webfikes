<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PusatInformasiHumasSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul_seksi' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul_seksi.required' => 'Judul seksi wajib diisi.',
        ];
    }
}
