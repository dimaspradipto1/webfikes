<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TriDharmaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'icon' => ['required', 'string', 'max:100'],
            'warna' => ['nullable', 'string', 'max:50'],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'urutan' => ['nullable', 'integer', 'min:0', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'icon.required' => 'Icon Bootstrap wajib diisi.',
            'judul.required' => 'Judul Tri Dharma wajib diisi.',
            'urutan.integer' => 'Urutan harus berupa angka.',
        ];
    }
}
