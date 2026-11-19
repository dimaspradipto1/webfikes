<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LayananRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $rincian = $this->input('rincian');
        if ($this->has('rincian_list') && is_array($this->input('rincian_list'))) {
            $filtered = array_values(array_filter(
                array_map('trim', $this->input('rincian_list')),
                fn ($val) => ! empty($val)
            ));
            $rincian = count($filtered) > 0 ? implode("\n", $filtered) : null;
        }

        $this->merge([
            'aktif' => $this->has('aktif') ? true : false,
            'rincian' => $rincian,
        ]);
    }

    public function rules(): array
    {
        return [
            'icon' => ['required', 'string', 'max:100'],
            'judul' => ['required', 'string', 'max:255'],
            'dasar_hukum' => ['nullable', 'string', 'max:255'],
            'link' => ['nullable', 'string', 'max:500'],
            'deskripsi' => ['required', 'string'],
            'rincian' => ['nullable', 'string'],
            'rincian_list' => ['nullable', 'array'],
            'rincian_list.*' => ['nullable', 'string', 'max:500'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'aktif' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'icon.required' => 'Icon wajib diisi.',
            'judul.required' => 'Judul program studi wajib diisi.',
            'judul.max' => 'Judul maksimal 255 karakter.',
            'link.max' => 'Link maksimal 500 karakter.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'urutan.integer' => 'Urutan harus berupa angka.',
            'urutan.min' => 'Urutan minimal 0.',
        ];
    }
}
