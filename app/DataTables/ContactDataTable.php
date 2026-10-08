<?php

namespace App\DataTables;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ContactDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Contact> $query
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->addColumn('no_wa', function ($contact) {
                return $contact->no_wa
                    ? e($contact->no_wa)
                    : '<span class="text-muted fst-italic">—</span>';
            })
            ->addColumn('email', function ($contact) {
                return $contact->email
                    ? e($contact->email)
                    : '<span class="text-muted fst-italic">—</span>';
            })
            ->addColumn('alamat', function ($contact) {
                if (!$contact->alamat) {
                    return '<span class="text-muted fst-italic">—</span>';
                }
                $clean = trim(html_entity_decode(strip_tags($contact->alamat), ENT_QUOTES, 'UTF-8'));
                return '<span title="' . e($clean) . '">' . e(\Illuminate\Support\Str::limit($clean, 50)) . '</span>';
            })
            ->addColumn('koordinat', function ($contact) {
                if ($contact->latitude && $contact->longitude) {
                    return e($contact->latitude) . ', ' . e($contact->longitude);
                }
                return '<span class="text-muted fst-italic">—</span>';
            })
            ->addColumn('action', function ($contact) {
                $btn  = '<div class="d-flex justify-content-center align-items-center" style="gap:5px">';

                // Tombol Edit
                $btn .= '<a href="' . route('contact.edit', $contact->id) . '"
                            class="btn btn-sm btn-warning text-white"
                            style="width:30px;height:30px;display:flex;align-items:center;justify-content:center"
                            title="Edit">
                            <i class="bi bi-pencil-fill" style="font-size:12px"></i>
                         </a>';

                // Tombol Hapus
                $btn .= '<form action="' . route('contact.destroy', $contact->id) . '"
                              method="POST" class="m-0"
                              onsubmit="return confirm(\'Yakin ingin menghapus kontak ini?\')">'
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
            ->rawColumns(['no_wa', 'email', 'alamat', 'koordinat', 'action']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Contact>
     */
    public function query(Contact $model): QueryBuilder
    {
        return $model->newQuery()->select(['id', 'latitude', 'longitude', 'no_wa', 'email', 'alamat']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('contact-table')
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

            Column::make('no_wa')
                ->title('No. WhatsApp'),

            Column::make('email')
                ->title('Email'),

            Column::make('alamat')
                ->title('Alamat'),

            Column::computed('koordinat')
                ->title('Koordinat (Lat, Long)'),

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
        return 'Contact_' . date('YmdHis');
    }
}
