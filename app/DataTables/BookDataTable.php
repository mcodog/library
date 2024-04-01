<?php

namespace App\DataTables;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use Barryvdh\Debugbar\Facades\Debugbar as DebugBar;
class BookDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function ($row) {
                $editBtn = '<a href="' . route('book.edit', $row->id) . '" class="btn btn-primary">Edit</a>';
                $deleteBtn = '<a href="book/'. $row->id .'/delete">Delete</href>';
                return $editBtn . ' ' . $deleteBtn;
            })
            ->addColumn('image', function ($book) {
                return "<img src='". url($book->getImage()) ."' alt='Manufacturer' style='width:50px;'>";
            })
            ->setRowId('id')
            ->rawColumns(['action', 'image']);
    }
    

    /**
     * Get the query source of dataTable.
     */
    public function query()
    {
        
    }
    

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('book-table')
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
            Column::make('title'),
            Column::make('name')->title('Author Name'),
            Column::make('nums')->title('Times Borrowed'),
            Column::make('genre_name')->title('Genre'),
            Column::computed('image'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Book_' . date('YmdHis');
    }
}
