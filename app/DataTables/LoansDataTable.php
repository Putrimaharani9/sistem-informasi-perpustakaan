<?php

namespace App\DataTables;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LoansDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'loan.action')
            ->editColumn('member_id', function (Loan $loan) {
                return $loan->member->name ?? 'Anggota Tidak Ditemukan';
            })
            ->editColumn('book_name', function (Loan $loan) {
                return $loan->book->title ?? 'Buku Tidak Ditemukan';
            })
            ->editColumn('is_returned', function (Loan $loan) {
                if ($loan->is_returned) {
                    return '<span class="badge badge-success">Sudah dikembalikan</span>';
                }

                return $loan->is_need_return ? '<span class="badge badge-danger">Belum dikembalikan</span>' : '';
            })
            ->editColumn('copy_id', function (Loan $loan) {
                return $loan->copy->code ?? 'Copy Tidak Ditemukan';
            })
            ->editColumn('actions', 'pages.loans.actions')
            ->rawColumns(['is_returned', 'actions'])
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Loan $model): QueryBuilder
    {
        return $model->with('member', 'book')->when($this->member_id, function ($query, $memberId) {
            $query->where('member_id', $memberId);
        })->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('loans-table')
            ->columns($this->getColumns())
            ->minifiedAjax($this->minifiedAjax ? $this->minifiedAjax : '')
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
            'DT_RowIndex' => ['title' => 'No.', 'searchable' => false, 'orderable' => false],
            'member_id' => ['title' => 'Peminjam'],
            'book_name' => ['title' => 'Judul Buku'],
            'copy_id' => ['title' => 'Kode Salinan'],
            'return_date' => ['title' => 'Tgl. Kembali'],
            'is_returned' => ['title' => 'Status'],
            'actions' => ['title' => '', 'searchable' => false, 'orderable' => false],
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Loan_' . date('YmdHis');
    }
}
