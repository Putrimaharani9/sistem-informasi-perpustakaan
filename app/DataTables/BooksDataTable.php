<?php

namespace App\DataTables;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BooksDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('copies', fn($row) => $row->copies->count())
            ->editColumn('category_id', fn($row) => $row->category->name ?? '')
            ->addColumn('cover', function ($row) {
                return $row->cover
                    ? '<img src="' . asset('storage/' . $row->cover) . '" width="60">'
                    : '-';
            })
            ->addColumn('actions', 'pages.books.actions')
            ->rawColumns(['cover', 'actions'])
            ->setRowId('id');
    }

    public function query(Book $model): QueryBuilder
    {
        return $model::with('copies', 'category')->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('books-table')
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
                Button::make('reload')
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('cover')->title('Cover'),
            Column::make('title')->title('Judul'),
            Column::make('author')->title('Penulis'),
            Column::make('publisher')->title('Penerbit'),
            Column::make('publish_year')->title('Tahun'),
            Column::make('category_id')->title('Kategori'),
            Column::make('copies')->title('Salinan'),
            Column::make('actions')->title('')->orderable(false)
        ];
    }

    protected function filename(): string
    {
        return 'Books_' . date('YmdHis');
    }
}
