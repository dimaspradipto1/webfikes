<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BahasaSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id') ?? $this->route('bahasa');

        return [
            'kode' => ['required', 'string', 'max:10', 'unique:bahasa_settings,kode,'.($id ? $id : 'NULL').',id'],
            'nama' => ['required', 'string', 'max:100'],
            'kode_negara' => ['nullable', 'string', 'max:10'],
            'urutan' => ['nullable', 'integer'],
        ];
    }
}
