<?php

namespace App\DataTables;

use App\Models\NilaiPerusahaan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Str;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class NilaiPerusahaanDataTable extends DataTable
{
    /**
     * @param QueryBuilder<NilaiPerusahaan> $query
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->addColumn('icon', fn ($n) => '<i class="bi ' . e($n->icon) . '" style="font-size:20px"></i>')
            ->addColumn('judul', fn ($n) => e($n->judul))
            ->addColumn('deskripsi', fn ($n) => e(Str::limit(trim(html_entity_decode(strip_tags($n->deskripsi ?? ''), ENT_QUOTES, 'UTF-8')), 90)))
            ->addColumn('urutan', fn ($n) => '<span class="badge bg-secondary">' . $n->urutan . '</span>')
            ->addColumn('action', function ($nilaiPerusahaan) {
                $btn  = '<div class="d-flex justify-content-center align-items-center" style="gap:5px">';
                $btn .= '<a href="' . route('nilaiperusahaan.edit', $nilaiPerusahaan->id) . '"
                            class="btn btn-sm btn-warning text-white"
                            style="width:30px;height:30px;display:flex;align-items:center;justify-content:center"
                            title="Edit">
                            <i class="bi bi-pencil-fill" style="font-size:12px"></i>
                         </a>';
                $btn .= '<form action="' . route('nilaiperusahaan.destroy', $nilaiPerusahaan->id) . '"
                              method="POST" class="m-0"
                              onsubmit="return confirm(\'Yakin ingin menghapus nilai ini?\')">'
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
            ->rawColumns(['icon', 'judul', 'deskripsi', 'urutan', 'action']);
    }

    /**
     * @return QueryBuilder<NilaiPerusahaan>
     */
    public function query(NilaiPerusahaan $model): QueryBuilder
    {
        return $model->newQuery()
            ->select(['id', 'icon', 'judul', 'deskripsi', 'urutan'])
            ->orderBy('urutan');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('nilaiperusahaan-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(4)
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
            Column::make('judul')->title('Judul'),
            Column::make('deskripsi')->title('Deskripsi'),
            Column::make('urutan')->title('Urutan')->width('8%')->addClass('text-center'),
            Column::computed('action')->title('Aksi')->exportable(false)->printable(false)->width('10%')->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'NilaiPerusahaan_' . date('YmdHis');
    }
}
