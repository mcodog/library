<?php

namespace App\DataTables;

use App\Models\Author;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;


class AuthorDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable($query)
    {
        return dataTables($query)
        ->addColumn('action', function ($row) {
                $editBtn = '<a href="author/'. $row->id .'/edit" class="btn btn-primary">Edit</a>';
                $deleteBtn = '<a href="author/'. $row->id .'/delete">Delete</href>';
                return $editBtn . ' ' . $deleteBtn;
            })
            ->addColumn('image', function ($author) {
                return "<img src='". url($author->getImage()) ."' alt='Manufacturer' style='width:50px;'>";
            })
            ->setRowId('id')
            ->rawColumns(['action', 'image']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Author $model)
    {
        
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('author-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
        
            Column::make('id'),
            Column::make('name'),
            Column::make('gender'),
            Column::make('age'),
            Column::computed('image')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Author_' . date('YmdHis');
    }
}
