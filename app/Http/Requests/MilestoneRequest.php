<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MilestoneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tahun' => ['nullable', 'integer', 'digits:4', 'min:1900', 'max:2100'],
            'judul' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'tahun.integer' => 'Tahun harus berupa angka.',
            'tahun.digits' => 'Tahun harus 4 digit.',
            'tahun.min' => 'Tahun minimal 1900.',
            'tahun.max' => 'Tahun maksimal 2100.',
            'judul.max' => 'Judul milestone maksimal 255 karakter.',
        ];
    }
}
