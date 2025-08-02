<?php

namespace App\DataTables;

use App\Models\Member;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class MembersDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
        ->eloquent($query) //// Gunakan collection agar accessor (getter) jalan
            ->addColumn('nik', fn($row) => $row->nik) // Sudah didekripsi otomatis
            ->addColumn('email', fn($row) => $row->email)
            ->addColumn('alamat', fn($row) => $row->alamat)
            ->addColumn('nomor_telepon', fn($row) => $row->nomor_telepon)
            ->addColumn('status_anggota', fn($row) => $row->status_anggota) // enum, tampilkan langsung
            ->addColumn('actions', fn($member) => view('pages.members.actions', compact('member'))->render())
            ->rawColumns(['actions']);
    }

    public function query(Member $model)
    {
        // get() agar return berupa Collection, bisa pakai accessor
        return $model->newQuery()->orderBy('nama', 'asc');
    }

    public function html(): Builder
    {
        return $this->builder()
            ->setTableId('members-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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

    protected function getColumns()
    {
        return [
            Column::make('id_anggota')->title('ID Anggota'),
            Column::make('nama')->title('Nama'),
            Column::make('nik')->title('NIK'),
            Column::make('email')->title('Email'),
            Column::make('alamat')->title('Alamat'),
            Column::make('nomor_telepon')->title('Nomor Telepon'),
            Column::make('status_anggota')->title('Status Anggota'),
            Column::computed('actions')
                ->title('Aksi')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Members_' . date('YmdHis');
    }
}
