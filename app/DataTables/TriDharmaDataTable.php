<?php

namespace App\DataTables;

use App\Models\TriDharma;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TriDharmaDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<TriDharma> $query
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->addColumn('icon_preview', function (TriDharma $item) {
                $color = $item->warna ?: '#823ca2';
                return '<div style="font-size:24px;color:' . e($color) . ';">'
                     . '<i class="bi ' . e($item->icon) . '"></i>'
                     . '</div>'
                     . '<span class="text-muted small">' . e($item->icon) . '</span>';
            })
            ->addColumn('judul', function (TriDharma $item) {
                return '<span class="fw-semibold">' . e($item->judul) . '</span>';
            })
            ->addColumn('deskripsi', function (TriDharma $item) {
                if (!$item->deskripsi) {
                    return '<span class="text-muted fst-italic">&mdash;</span>';
                }
                $clean = trim(html_entity_decode(strip_tags($item->deskripsi), ENT_QUOTES, 'UTF-8'));
                return '<span title="' . e($clean) . '">'
                      . e(\Illuminate\Support\Str::limit($clean, 65))
                      . '</span>';
            })
            ->addColumn('urutan', function (TriDharma $item) {
                return '<span class="badge bg-secondary">' . $item->urutan . '</span>';
            })
            ->addColumn('status', function (TriDharma $item) {
                return $item->is_active
                    ? '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Aktif</span>'
                    : '<span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Nonaktif</span>';
            })
            ->addColumn('action', function (TriDharma $item) {
                $btn  = '<div class="d-flex justify-content-center align-items-center" style="gap:5px">';

                // Tombol Edit
                $btn .= '<a href="' . route('tridharma.edit', $item->id) . '"
                            class="btn btn-sm btn-warning text-white"
                            style="width:30px;height:30px;display:flex;align-items:center;justify-content:center"
                            title="Edit">
                            <i class="bi bi-pencil-fill" style="font-size:12px"></i>
                         </a>';

                // Tombol Hapus
                $btn .= '<form action="' . route('tridharma.destroy', $item->id) . '"
                              method="POST" class="m-0"
                              onsubmit="return confirm(\'Yakin ingin menghapus item Tri Dharma ini?\')">'
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
            ->rawColumns(['icon_preview', 'judul', 'deskripsi', 'urutan', 'status', 'action']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<TriDharma>
     */
    public function query(TriDharma $model): QueryBuilder
    {
        return $model->newQuery()
            ->select(['id', 'icon', 'warna', 'judul', 'deskripsi', 'urutan', 'is_active'])
            ->orderBy('urutan');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('tridharma-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(5)
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

            Column::computed('icon_preview')
                ->title('Icon & Warna')
                ->width('12%')
                ->addClass('text-center')
                ->exportable(false)
                ->printable(false),

            Column::make('judul')
                ->title('Judul Pilar / Bidang'),

            Column::make('deskripsi')
                ->title('Deskripsi'),

            Column::computed('status')
                ->title('Status')
                ->width('10%')
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
        return 'TriDharma_' . date('YmdHis');
    }
}
