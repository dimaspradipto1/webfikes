<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlumniTestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'pekerjaan' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:150'],
            'bintang' => ['required', 'integer', 'min:1', 'max:5'],
            'pesan' => ['required', 'string', 'max:2000'],
            'website_hp' => ['nullable', 'max:0'],
            'captcha' => [
                'required',
                'numeric',
                function (string $attribute, mixed $value, \Closure $fail) {
                    $expected = session('alumni_captcha_answer');
                    if ($expected === null || trim((string) $value) !== (string) $expected) {
                        $fail('Jawaban verifikasi captcha salah. Silakan coba lagi.');
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'pekerjaan.required' => 'Profesi / instansi / angkatan wajib diisi.',
            'kategori.required' => 'Kategori hubungan wajib dipilih.',
            'bintang.required' => 'Rating kepuasan bintang wajib dipilih.',
            'pesan.required' => 'Pesan / testimoni Anda wajib diisi.',
            'website_hp.max' => 'Permintaan tidak valid (terdeteksi spam).',
            'captcha.required' => 'Verifikasi captcha wajib diisi sebelum mengirim testimoni.',
            'captcha.numeric' => 'Jawaban captcha harus berupa angka.',
        ];
    }
}
