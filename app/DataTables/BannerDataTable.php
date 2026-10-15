<?php

namespace App\DataTables;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Str;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BannerDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder<Banner>  $query
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->addColumn('gambar', function ($banner) {
                if ($banner->url) {
                    return '<img src="'.asset('storage/'.$banner->url).'"
                                 alt="'.e($banner->judul ?? 'Banner').'"
                                 style="width:120px;height:60px;object-fit:cover;border-radius:6px;border:1px solid #dee2e6"
                                 loading="lazy">';
                }

                return '<span class="text-muted small">Tidak ada gambar</span>';
            })
            ->addColumn('judul', function ($banner) {
                return $banner->judul
                    ? '<span title="'.e($banner->judul).'">'.e(Str::limit($banner->judul, 40)).'</span>'
                    : '<span class="text-muted fst-italic">—</span>';
            })
            ->addColumn('urutan', function ($banner) {
                return '<span class="badge bg-secondary">'.$banner->urutan.'</span>';
            })
            ->addColumn('aktif', function ($banner) {
                if ($banner->aktif) {
                    return '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Aktif</span>';
                }

                return '<span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Nonaktif</span>';
            })
            ->addColumn('action', function ($banner) {
                $btn = '<div class="d-flex justify-content-center align-items-center" style="gap:5px">';

                // Tombol Edit
                $btn .= '<a href="'.route('banner.edit', $banner->id).'"
                            class="btn btn-sm btn-warning text-white"
                            style="width:30px;height:30px;display:flex;align-items:center;justify-content:center"
                            title="Edit">
                            <i class="bi bi-pencil-fill" style="font-size:12px"></i>
                         </a>';

                // Tombol Hapus
                $btn .= '<form action="'.route('banner.destroy', $banner->id).'"
                              method="POST" class="m-0"
                              onsubmit="return confirm(\'Yakin ingin menghapus banner ini?\')">'
                        .csrf_field().method_field('DELETE')
                        .'<button type="submit"
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
            ->rawColumns(['gambar', 'judul', 'urutan', 'aktif', 'action']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Banner>
     */
    public function query(Banner $model): QueryBuilder
    {
        return $model->newQuery()
            ->select(['id', 'judul', 'url', 'urutan', 'aktif'])
            ->orderBy('urutan');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('banner-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(3) // order by urutan
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

            Column::computed('gambar')
                ->title('Preview')
                ->width('15%')
                ->addClass('text-center')
                ->exportable(false)
                ->printable(false),

            Column::make('judul')
                ->title('Judul'),

            Column::make('urutan')
                ->title('Urutan')
                ->width('8%')
                ->addClass('text-center'),

            Column::make('aktif')
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
        return 'Banner_'.date('YmdHis');
    }
}
