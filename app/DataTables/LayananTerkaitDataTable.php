<?php

namespace App\DataTables;

use App\Models\LayananTerkait;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LayananTerkaitDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<LayananTerkait> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->addColumn('logo', function ($item) {
                if ($item->logo_url) {
                    return '<div class="d-flex align-items-center justify-content-center" style="width:52px; height:52px;">
                                <img src="' . e($item->logo_url) . '" alt="' . e($item->nama) . '" style="max-width:50px; max-height:50px; width:auto; height:auto; object-fit:contain; display:block;">
                            </div>';
                }
                $icon = $item->icon ?: 'bi-link-45deg';
                return '<div class="d-flex align-items-center justify-content-center" style="width:52px; height:52px; font-size:26px; color:#046B26;">
                            <i class="bi ' . e($icon) . '"></i>
                        </div>';
            })
            ->addColumn('nama', function ($item) {
                $html = '<div class="text-start">';
                $html .= '<div class="fw-bold text-dark" style="font-size:14px; letter-spacing:0.3px;">' . e($item->nama) . '</div>';
                if ($item->deskripsi) {
                    $cleanDesc = trim(html_entity_decode(strip_tags($item->deskripsi), ENT_QUOTES, 'UTF-8'));
                    $shortDesc = mb_strimwidth($cleanDesc, 0, 75, '...');
                    $html .= '<small class="text-muted d-block mt-1" style="font-size:12px; line-height:1.35;">' . e($shortDesc) . '</small>';
                }
                $html .= '</div>';
                return $html;
            })
            ->addColumn('url', function ($item) {
                if (empty($item->url)) {
                    return '<span class="text-muted">—</span>';
                }
                $shortUrl = mb_strimwidth($item->url, 0, 32, '...');
                return '<a href="' . e($item->url) . '" target="_blank" rel="noopener noreferrer" 
                           class="btn btn-xs d-inline-flex align-items-center text-truncate" 
                           style="font-size:11.5px; padding: 4px 10px; background-color: #fff6e8; color: #d67d00; border: 1px solid #ffd899; border-radius: 6px; font-weight:600; max-width:240px;" 
                           title="' . e($item->url) . '">
                            <i class="bi bi-box-arrow-up-right me-1 text-warning"></i> ' . e($shortUrl) . '
                        </a>';
            })
            ->addColumn('urutan', function ($item) {
                return '<span class="badge rounded-pill text-white" style="background-color:#6c757d; font-size:12px; font-weight:700; padding:5px 10px;">' . $item->urutan . '</span>';
            })
            ->addColumn('is_active', function ($item) {
                return $item->is_active
                    ? '<span class="badge" style="background-color:#198754; font-size:11.5px; font-weight:600; padding:6px 12px; border-radius:50px;"><i class="bi bi-check-circle-fill me-1"></i>Aktif</span>'
                    : '<span class="badge" style="background-color:#dc3545; font-size:11.5px; font-weight:600; padding:6px 12px; border-radius:50px;"><i class="bi bi-x-circle-fill me-1"></i>Nonaktif</span>';
            })
            ->addColumn('action', function ($item) {
                $btn  = '<div class="d-flex justify-content-center align-items-center" style="gap:6px">';
                $btn .= '<a href="' . route('layanan-terkait.edit', $item->id) . '"
                            class="btn btn-sm"
                            style="width:32px; height:32px; display:flex; align-items:center; justify-content:center; background-color:#ff9c00; color:#ffffff; border:none; border-radius:6px; box-shadow:0 2px 5px rgba(255,156,0,0.35);"
                            title="Edit">
                            <i class="bi bi-pencil-fill" style="font-size:12px"></i>
                         </a>';
                $btn .= '<form action="' . route('layanan-terkait.destroy', $item->id) . '"
                               method="POST" class="m-0"
                               onsubmit="return confirm(\'Yakin ingin menghapus layanan terkait ini?\')">'
                        . csrf_field() . method_field('DELETE')
                        . '<button type="submit"
                                   class="btn btn-sm"
                                   style="width:32px; height:32px; display:flex; align-items:center; justify-content:center; background-color:#dc3545; color:#ffffff; border:none; border-radius:6px; box-shadow:0 2px 5px rgba(220,53,69,0.35);"
                                   title="Hapus">
                            <i class="bi bi-trash-fill" style="font-size:12px"></i>
                          </button>
                         </form>';
                $btn .= '</div>';
                return $btn;
            })
            ->setRowId('id')
            ->rawColumns(['logo', 'nama', 'url', 'urutan', 'is_active', 'action']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @param LayananTerkait $model
     * @return QueryBuilder<LayananTerkait>
     */
    public function query(LayananTerkait $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('urutan');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('layanan-terkait-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(4, 'asc')
            ->selectStyleSingle()
            ->parameters([
                'pageLength' => 10,
                'language' => [
                    'search' => 'Search:',
                    'lengthMenu' => '_MENU_ entries per page',
                    'info' => 'Showing _START_ to _END_ of _TOTAL_ entries',
                    'paginate' => [
                        'first' => '«',
                        'last' => '»',
                        'next' => '›',
                        'previous' => '‹'
                    ]
                ]
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->width('5%')->addClass('text-center align-middle')->searchable(false)->orderable(false),
            Column::computed('logo')->title('Logo / Icon')->width('10%')->addClass('text-center align-middle')->exportable(false)->printable(false),
            Column::make('nama')->title('Nama Layanan')->addClass('align-middle'),
            Column::computed('url')->title('Tautan / URL')->width('22%')->addClass('align-middle'),
            Column::make('urutan')->title('Urutan')->width('8%')->addClass('text-center align-middle'),
            Column::make('is_active')->title('Status')->width('10%')->addClass('text-center align-middle'),
            Column::computed('action')->title('Aksi')->exportable(false)->printable(false)->width('10%')->addClass('text-center align-middle'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'LayananTerkait_' . date('YmdHis');
    }
}
