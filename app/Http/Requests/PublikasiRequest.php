<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublikasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'publikasis' => ['required', 'array', 'min:1'],
            'publikasis.*.judul' => ['required', 'string', 'max:255'],
            'publikasis.*.icon' => ['nullable', 'string', 'max:100'],
            'publikasis.*.link' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'publikasis.*.judul.required' => 'Nama Menu Publikasi tidak boleh kosong.',
        ];
    }
}
