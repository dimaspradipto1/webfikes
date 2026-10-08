<?php

namespace App\DataTables;

use App\Models\TenagaPendidik;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TenagaPendidikDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<TenagaPendidik> $query
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->addColumn('avatar_preview', function (TenagaPendidik $item) {
                if ($item->foto) {
                    return '<img src="' . asset('storage/' . $item->foto) . '" '
                         . 'alt="' . e($item->nama) . '" '
                         . 'style="width:45px;height:45px;object-fit:cover;border-radius:50%;border:2px solid #823ca2;">';
                }
                return '<div style="width:45px;height:45px;background:#f3ebf8;color:#823ca2;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-size:22px;border:2px solid #e1c9ee;">'
                     . '<i class="bi ' . e($item->icon ?: 'bi-person-fill') . '"></i>'
                     . '</div>';
            })
            ->addColumn('nama', function (TenagaPendidik $item) {
                return '<span class="fw-bold text-dark">' . e($item->nama) . '</span>';
            })
            ->addColumn('bidang', function (TenagaPendidik $item) {
                return $item->bidang
                    ? '<span class="badge" style="background:#fff3e0;color:#e67e22;font-size:12px;">' . e($item->bidang) . '</span>'
                    : '<span class="text-muted fst-italic">&mdash;</span>';
            })
            ->addColumn('prodi', function (TenagaPendidik $item) {
                if ($item->layanan) {
                    return '<span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1">'
                         . e($item->layanan->judul)
                         . '</span>';
                }
                return '<span class="text-muted small fst-italic">Semua / Default</span>';
            })
            ->addColumn('keterangan', function (TenagaPendidik $item) {
                if (!$item->keterangan) {
                    return '<span class="text-muted fst-italic">&mdash;</span>';
                }
                $clean = trim(html_entity_decode(strip_tags($item->keterangan), ENT_QUOTES, 'UTF-8'));
                return '<span title="' . e($clean) . '">'
                      . e(\Illuminate\Support\Str::limit($clean, 50))
                      . '</span>';
            })
            ->addColumn('urutan', function (TenagaPendidik $item) {
                return '<span class="badge bg-secondary">' . $item->urutan . '</span>';
            })
            ->addColumn('status', function (TenagaPendidik $item) {
                return $item->is_active
                    ? '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Aktif</span>'
                    : '<span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Nonaktif</span>';
            })
            ->addColumn('action', function (TenagaPendidik $item) {
                $btn  = '<div class="d-flex justify-content-center align-items-center" style="gap:5px">';

                // Tombol Edit
                $btn .= '<a href="' . route('tenaga-pendidik.edit', $item->id) . '"
                            class="btn btn-sm btn-warning text-white"
                            style="width:30px;height:30px;display:flex;align-items:center;justify-content:center"
                            title="Edit">
                            <i class="bi bi-pencil-fill" style="font-size:12px"></i>
                         </a>';

                // Tombol Hapus
                $btn .= '<form action="' . route('tenaga-pendidik.destroy', $item->id) . '"
                              method="POST" class="m-0"
                              onsubmit="return confirm(\'Yakin ingin menghapus item Tenaga Pendidik ini?\')">'
                        . csrf_field() . method_field('DELETE')
                        . '<button type="submit"
                                   class="btn btn-sm btn-danger"
                                   style="width:30px;height:30px;display:flex;align-items:center;justify-content:center"
                                   title="Hapus">
                            <i class="bi bi-trash-fill" style="font-size:12px"></i>
                          </button>
                         </form>';

                $btn .= '</div>';
                return $btn;
            })
            ->setRowId('DT_RowIndex')
            ->rawColumns(['avatar_preview', 'nama', 'bidang', 'prodi', 'keterangan', 'urutan', 'status', 'action']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<TenagaPendidik>
     */
    public function query(TenagaPendidik $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('layanan')
            ->select(['id', 'layanan_id', 'nama', 'bidang', 'keterangan', 'foto', 'icon', 'link', 'tombol_teks', 'urutan', 'is_active'])
            ->orderBy('urutan');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('tenaga-pendidik-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(6)
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

            Column::computed('avatar_preview')
                ->title('Foto / Icon')
                ->width('10%')
                ->addClass('text-center')
                ->exportable(false)
                ->printable(false),

            Column::make('nama')
                ->title('Kelompok / Nama'),

            Column::make('bidang')
                ->title('Spesialisasi / Bidang'),

            Column::make('prodi')
                ->title('Terkait Prodi'),

            Column::make('keterangan')
                ->title('Keterangan'),

            Column::computed('status')
                ->title('Status')
                ->width('8%')
                ->addClass('text-center')
                ->exportable(false)
                ->printable(false),

            Column::make('urutan')
                ->title('Urutan')
                ->width('8%')
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
        return 'TenagaPendidik_' . date('YmdHis');
    }
}
