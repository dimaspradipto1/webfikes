<?php

namespace App\DataTables;

use App\Models\Feature;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FeatureDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Feature> $query
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->addColumn('icon_preview', function ($feature) {
                return '<div style="font-size:24px;color:var(--terracotta);"><i class="bi ' . e($feature->icon) . '"></i></div>'
                     . '<span class="text-muted small">' . e($feature->icon) . '</span>';
            })
            ->addColumn('judul', function ($feature) {
                return '<span class="fw-semibold">' . e($feature->judul) . '</span>';
            })
            ->addColumn('deskripsi', function ($feature) {
                if (!$feature->deskripsi) {
                    return '<span class="text-muted fst-italic">—</span>';
                }
                $clean = trim(html_entity_decode(strip_tags($feature->deskripsi), ENT_QUOTES, 'UTF-8'));
                return '<span title="' . e($clean) . '">' . e(\Illuminate\Support\Str::limit($clean, 60)) . '</span>';
            })
            ->addColumn('urutan', function ($feature) {
                return '<span class="badge bg-secondary">' . $feature->urutan . '</span>';
            })
            ->addColumn('action', function ($feature) {
                $btn  = '<div class="d-flex justify-content-center align-items-center" style="gap:5px">';

                // Tombol Edit
                $btn .= '<a href="' . route('feature.edit', $feature->id) . '"
                            class="btn btn-sm btn-warning text-white"
                            style="width:30px;height:30px;display:flex;align-items:center;justify-content:center"
                            title="Edit">
                            <i class="bi bi-pencil-fill" style="font-size:12px"></i>
                         </a>';

                // Tombol Hapus
                $btn .= '<form action="' . route('feature.destroy', $feature->id) . '"
                              method="POST" class="m-0"
                              onsubmit="return confirm(\'Yakin ingin menghapus keunggulan ini?\')">'
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
            ->rawColumns(['icon_preview', 'judul', 'deskripsi', 'urutan', 'action']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Feature>
     */
    public function query(Feature $model): QueryBuilder
    {
        return $model->newQuery()
            ->select(['id', 'icon', 'judul', 'deskripsi', 'urutan'])
            ->orderBy('urutan');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('feature-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(4) // order by urutan
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
                ->title('Icon')
                ->width('15%')
                ->addClass('text-center')
                ->exportable(false)
                ->printable(false),

            Column::make('judul')
                ->title('Judul'),

            Column::make('deskripsi')
                ->title('Deskripsi'),

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
        return 'Feature_' . date('YmdHis');
    }
}
