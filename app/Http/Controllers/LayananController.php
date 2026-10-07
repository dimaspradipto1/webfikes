<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LayananController extends Controller
{
    public function index(): View
    {
        $prodis = Layanan::orderBy('urutan')->get();

        if ($prodis->isEmpty()) {
            $defaults = [
                [
                    'icon'        => 'bi-mortarboard-fill',
                    'judul'       => 'Program Magister (S2) Kesehatan Masyarakat',
                    'dasar_hukum' => 'SK LAM-PTKes & Kemendikbudristek',
                    'link'        => '',
                    'deskripsi'   => 'Program Magister Kesehatan Masyarakat (M.Kes) yang berfokus pada manajemen kebijakan publik, epidemiologi terapan, dan kepemimpinan kesehatan.',
                    'urutan'      => 1,
                    'aktif'       => true,
                ],
                [
                    'icon'        => 'bi-shield-plus',
                    'judul'       => 'Program Sarjana (S1) Kesehatan dan Keselamatan Kerja',
                    'dasar_hukum' => 'SK LAM-PTKes & Kemendikbudristek',
                    'link'        => '',
                    'deskripsi'   => 'Menghasilkan sarjana K3 yang kompeten dalam manajemen risiko, higiene industri, ergonomi, dan SMK3.',
                    'urutan'      => 2,
                    'aktif'       => true,
                ],
                [
                    'icon'        => 'bi-tree-fill',
                    'judul'       => 'Program Sarjana (S1) Kesehatan Lingkungan',
                    'dasar_hukum' => 'SK LAM-PTKes & Kemendikbudristek',
                    'link'        => '',
                    'deskripsi'   => 'Mendidik sarjana kesehatan lingkungan yang ahli dalam AMDAL, pengelolaan limbah B3 industri, dan sanitasi rumah sakit.',
                    'urutan'      => 3,
                    'aktif'       => true,
                ],
                [
                    'icon'        => 'bi-hospital',
                    'judul'       => 'Laboratorium Terpadu & Layanan Pengujian',
                    'dasar_hukum' => 'Standar Sarpras Dikti',
                    'link'        => '',
                    'deskripsi'   => 'Fasilitas laboratorium terpadu untuk praktikum, riset dosen, dan layanan pengujian lingkungan kerja.',
                    'urutan'      => 4,
                    'aktif'       => true,
                ],
            ];

            foreach ($defaults as $d) {
                Layanan::create($d);
            }

            $prodis = Layanan::orderBy('urutan')->get();
        }

        return view('pages.layanan.index', compact('prodis'));
    }

    public function updateAll(Request $request): RedirectResponse
    {
        $request->validate([
            'prodis'         => ['required', 'array', 'min:1'],
            'prodis.*.judul' => ['required', 'string', 'max:255'],
            'prodis.*.icon'  => ['nullable', 'string', 'max:100'],
            'prodis.*.link'  => ['nullable', 'string', 'max:500'],
        ], [
            'prodis.*.judul.required' => 'Nama Program Studi tidak boleh kosong.',
        ]);

        $submittedIds = [];
        $prodisInput = $request->input('prodis', []);

        foreach ($prodisInput as $index => $data) {
            $id = !empty($data['id']) ? $data['id'] : null;
            $linkValue = !empty(trim($data['link'] ?? '')) ? trim($data['link']) : null;
            if ($linkValue && !str_starts_with($linkValue, 'http://') && !str_starts_with($linkValue, 'https://') && !str_starts_with($linkValue, '/') && !str_starts_with($linkValue, '#')) {
                $linkValue = 'https://' . $linkValue;
            }

            $payload = [
                'icon'        => $data['icon'] ?? 'bi-mortarboard-fill',
                'judul'       => $data['judul'],
                'dasar_hukum' => $data['dasar_hukum'] ?? null,
                'link'        => $linkValue,
                'deskripsi'   => !empty($data['deskripsi']) ? $data['deskripsi'] : $data['judul'],
                'rincian'     => !empty($data['rincian']) ? $data['rincian'] : null,
                'urutan'      => $index + 1,
                'aktif'       => isset($data['aktif']) && $data['aktif'] == '1',
            ];

            if ($id && ($existing = Layanan::find($id))) {
                $existing->update($payload);
                $submittedIds[] = $existing->id;
            } else {
                $new = Layanan::create($payload);
                $submittedIds[] = $new->id;
            }
        }

        if (!empty($submittedIds)) {
            Layanan::whereNotIn('id', $submittedIds)->delete();
        }

        alert()->success('Berhasil!', 'Pengaturan Link Menu Program Studi berhasil disimpan.');

        return redirect()->route('layanan.index');
    }
}
