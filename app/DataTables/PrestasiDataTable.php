<?php

namespace App\DataTables;

use App\Models\Prestasi;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PrestasiDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder<Prestasi>  $query
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->addColumn('foto', function ($prestasi) {
                if ($prestasi->foto) {
                    return '<img src="'.asset('storage/'.$prestasi->foto).'"
                                 alt="'.e($prestasi->judul_prestasi).'"
                                 style="width:70px;height:50px;object-fit:cover;border-radius:6px;border:1px solid #dee2e6"
                                 loading="lazy">';
                }

                return '<span class="badge bg-light text-muted border">No Image</span>';
            })
            ->addColumn('judul_prestasi', function ($prestasi) {
                $html = '<div class="fw-semibold text-dark">'.e($prestasi->judul_prestasi).'</div>';
                if ($prestasi->penyelenggara) {
                    $html .= '<div class="text-muted small" style="font-size:11px"><i class="bi bi-building me-1"></i>'.e($prestasi->penyelenggara).'</div>';
                }

                return $html;
            })
            ->addColumn('mahasiswa', function ($prestasi) {
                $html = '<div class="fw-medium text-primary"><i class="bi bi-person-fill me-1"></i>'.e($prestasi->nama_mahasiswa).'</div>';
                if ($prestasi->prodi) {
                    $html .= '<span class="badge bg-light text-dark border" style="font-size:10.5px">'.e($prestasi->prodi).'</span>';
                }

                return $html;
            })
            ->addColumn('tingkat_peringkat', function ($prestasi) {
                $badgeClass = match ($prestasi->tingkat) {
                    'Internasional' => 'bg-danger',
                    'Nasional' => 'bg-success',
                    'Provinsi / Wilayah' => 'bg-primary',
                    default => 'bg-secondary',
                };

                $html = '<span class="badge '.$badgeClass.' px-2 py-1 mb-1">'.e($prestasi->tingkat).'</span>';
                if ($prestasi->peringkat) {
                    $html .= '<div class="badge bg-warning text-dark fw-bold" style="font-size:10.5px"><i class="bi bi-trophy-fill me-1"></i>'.e($prestasi->peringkat).'</div>';
                }

                return $html;
            })
            ->addColumn('tahun', function ($prestasi) {
                return $prestasi->tahun ? '<span class="badge bg-light text-dark border">'.e($prestasi->tahun).'</span>' : '-';
            })
            ->addColumn('status', function ($prestasi) {
                if ($prestasi->is_active) {
                    return '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Aktif</span>';
                }

                return '<span class="badge bg-secondary">Nonaktif</span>';
            })
            ->addColumn('action', function ($prestasi) {
                $btn = '<div class="d-flex justify-content-center align-items-center" style="gap:5px">';

                // Tombol Edit
                $btn .= '<a href="'.route('prestasi.edit', $prestasi->id).'"
                            class="btn btn-sm btn-warning text-white"
                            style="width:32px;height:32px;display:flex;align-items:center;justify-content:center;border-radius:6px"
                            title="Edit">
                            <i class="bi bi-pencil-fill" style="font-size:12px"></i>
                         </a>';

                // Tombol Hapus
                $btn .= '<form action="'.route('prestasi.destroy', $prestasi->id).'"
                              method="POST" class="m-0"
                              onsubmit="return confirm(\'Yakin ingin menghapus data prestasi mahasiswa ini?\')">'
                        .csrf_field().method_field('DELETE')
                        .'<button type="submit"
                                   class="btn btn-sm btn-danger"
                                   style="width:32px;height:32px;display:flex;align-items:center;justify-content:center;border-radius:6px"
                                   title="Hapus">
                            <i class="bi bi-trash-fill" style="font-size:12px"></i>
                           </button>
                         </form>';

                $btn .= '</div>';

                return $btn;
            })
            ->setRowId('DT_RowIndex')
            ->rawColumns(['foto', 'judul_prestasi', 'mahasiswa', 'tingkat_peringkat', 'tahun', 'status', 'action']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Prestasi>
     */
    public function query(Prestasi $model): QueryBuilder
    {
        return $model->newQuery()->select([
            'id',
            'foto',
            'judul_prestasi',
            'nama_mahasiswa',
            'nim',
            'prodi',
            'tingkat',
            'peringkat',
            'penyelenggara',
            'tahun',
            'is_active',
            'urutan',
            'created_at',
        ])->latest('id');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('prestasi-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')
                ->title('No')
                ->width('5%')
                ->addClass('text-center')
                ->searchable(false)
                ->orderable(false),

            Column::computed('foto')
                ->title('Foto / Sertifikat')
                ->width('12%')
                ->addClass('text-center')
                ->exportable(false)
                ->printable(false),

            Column::make('judul_prestasi')
                ->title('Nama Prestasi & Penyelenggara'),

            Column::computed('mahasiswa')
                ->title('Mahasiswa & Prodi')
                ->width('20%'),

            Column::computed('tingkat_peringkat')
                ->title('Tingkat & Peringkat')
                ->width('15%')
                ->addClass('text-center'),

            Column::computed('tahun')
                ->title('Tahun')
                ->width('8%')
                ->addClass('text-center'),

            Column::make('status')
                ->title('Status')
                ->width('10%')
                ->addClass('text-center'),

            Column::computed('action')
                ->title('Aksi')
                ->exportable(false)
                ->printable(false)
                ->width('10%')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PrestasiMahasiswa_'.date('YmdHis');
    }
}
