<?php

namespace App\Imports;

use App\Models\Book;
use App\Models\BookCopy;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class BookCopiesImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new BookCopy([
            'title' => $row['Judul'],
            'code' => $row['Kode'],
            'book_id' => Book::where('title', $row['Judul'])->first()->id,
            'created_by' => auth()->user()->id
        ]);
    }

    public function headingRow(): int
    {
        return 5;
    }

    public function prepareForValidation($data, $index)
    {
        return $data;
    }

    public function rules(): array
    {
        return [
            'Judul' => 'required|exists:books,title',
            'Kode' => 'required|unique:book_copies,code',
        ];
    }
}
