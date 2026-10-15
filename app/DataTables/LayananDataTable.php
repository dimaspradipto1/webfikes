<?php

namespace App\DataTables;

use App\Models\Layanan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LayananDataTable extends DataTable
{
    /**
     * @param  QueryBuilder<Layanan>  $query
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->addColumn('icon', fn ($l) => '<i class="bi '.e($l->icon).'" style="font-size:20px"></i>')
            ->addColumn('judul', fn ($l) => e($l->judul))
            ->addColumn('dasar_hukum', fn ($l) => $l->dasar_hukum
                ? '<span class="badge bg-secondary">'.e($l->dasar_hukum).'</span>'
                : '<span class="text-muted">—</span>')
            ->addColumn('link', function ($l) {
                if (empty($l->link)) {
                    return '<span class="text-muted">—</span>';
                }

                return '<a href="'.e($l->link).'" target="_blank" class="btn btn-xs btn-outline-primary" style="font-size:11px; padding: 2px 6px;" title="'.e($l->link).'">
                            <i class="bi bi-box-arrow-up-right me-1"></i>Buka Link
                        </a>';
            })
            ->addColumn('urutan', fn ($l) => '<span class="badge bg-secondary">'.$l->urutan.'</span>')
            ->addColumn('aktif', function ($l) {
                return $l->aktif
                    ? '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Aktif</span>'
                    : '<span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Nonaktif</span>';
            })
            ->addColumn('action', function ($layanan) {
                $btn = '<div class="d-flex justify-content-center align-items-center" style="gap:5px">';
                $btn .= '<a href="'.route('layanan.edit', $layanan->id).'"
                            class="btn btn-sm btn-warning text-white"
                            style="width:30px;height:30px;display:flex;align-items:center;justify-content:center"
                            title="Edit">
                            <i class="bi bi-pencil-fill" style="font-size:12px"></i>
                         </a>';
                $btn .= '<form action="'.route('layanan.destroy', $layanan->id).'"
                              method="POST" class="m-0"
                              onsubmit="return confirm(\'Yakin ingin menghapus program studi ini?\')">'
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
            ->rawColumns(['icon', 'judul', 'dasar_hukum', 'link', 'urutan', 'aktif', 'action']);
    }

    /**
     * @return QueryBuilder<Layanan>
     */
    public function query(Layanan $model): QueryBuilder
    {
        return $model->newQuery()
            ->select(['id', 'icon', 'judul', 'dasar_hukum', 'link', 'urutan', 'aktif'])
            ->orderBy('urutan');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('layanan-table')
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

    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->width('5%')->addClass('text-center')->searchable(false)->orderable(false),
            Column::computed('icon')->title('Icon')->width('8%')->addClass('text-center')->exportable(false)->printable(false),
            Column::make('judul')->title('Program Studi'),
            Column::make('dasar_hukum')->title('SK / Akreditasi')->width('18%'),
            Column::computed('link')->title('Link Prodi')->width('12%')->addClass('text-center'),
            Column::make('urutan')->title('Urutan')->width('8%')->addClass('text-center'),
            Column::make('aktif')->title('Status')->width('10%')->addClass('text-center'),
            Column::computed('action')->title('Aksi')->exportable(false)->printable(false)->width('10%')->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Layanan_'.date('YmdHis');
    }
}
