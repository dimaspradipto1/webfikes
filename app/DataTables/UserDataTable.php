<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder<User>  $query
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->addColumn('name', fn ($item) => e($item->name))
            ->addColumn('email', fn ($item) => e($item->email))
            ->addColumn('roles', function ($item) {
                $roles = array_filter($item->roles_array, fn ($r) => in_array($r, ['admin', 'penulis', 'organisasi']));
                $html = '<div class="d-flex flex-wrap gap-1 justify-content-center">';
                foreach ($roles as $r) {
                    $badge = match ($r) {
                        'admin' => ['label' => 'Admin',          'class' => 'bg-primary text-white', 'style' => ''],
                        'penulis' => ['label' => 'Penulis Berita', 'class' => 'bg-warning text-dark',  'style' => ''],
                        'organisasi' => ['label' => 'Organisasi',     'class' => 'text-white',            'style' => 'background:#823ca2;'],
                        default => ['label' => ucfirst($r),      'class' => 'bg-secondary text-white', 'style' => ''],
                    };
                    $html .= '<span class="badge rounded-pill '.$badge['class'].'" style="'.$badge['style'].'">'.$badge['label'].'</span>';
                }
                $html .= '</div>';

                return $html;
            })
            ->addColumn('action', function ($user) {
                $btn = '<div class="d-flex justify-content-center align-items-center" style="gap:5px">';

                // Tombol Update Password
                $btn .= '<a href="'.route('user.updatePasswordForm', $user->id).'"
                            class="btn btn-sm btn-info text-white"
                            style="width:30px;height:30px;display:flex;align-items:center;justify-content:center"
                            title="Update Password">
                            <i class="bi bi-key-fill" style="font-size:12px"></i>
                         </a>';

                // Tombol Edit
                $btn .= '<a href="'.route('user.edit', $user->id).'"
                            class="btn btn-sm btn-warning text-white"
                            style="width:30px;height:30px;display:flex;align-items:center;justify-content:center"
                            title="Edit">
                            <i class="bi bi-pencil-fill" style="font-size:12px"></i>
                         </a>';

                // Tombol Hapus
                $btn .= '<form action="'.route('user.destroy', $user->id).'"
                              method="POST" class="m-0"
                              onsubmit="return confirm(\'Yakin ingin menghapus pengguna ini?\')">'
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
            ->rawColumns(['action', 'roles']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<User>
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->select(['id', 'name', 'email', 'roles']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
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

            Column::make('name')
                ->title('Nama Pengguna'),

            Column::make('email')
                ->title('Email'),

            Column::make('roles')
                ->title('Hak Akses')
                ->addClass('text-center'),

            Column::computed('action')
                ->title('Aksi')
                ->exportable(false)
                ->printable(false)
                ->width('12%')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_'.date('YmdHis');
    }
}
