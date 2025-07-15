<?php

namespace App\Imports;

use App\Models\Book;
use App\Models\BookCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class BooksImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Book([
            'title' => $row['Judul'],
            'author' => $row['Penulis'],
            'publisher' => $row['Penerbit'],
            'publish_year' => $row['Tahun Terbit'],
            'category_id' => $row['category_id'],
            'created_by' => auth()->user()->id
        ]);
    }

    public function headingRow(): int
    {
        return 5;
    }

    public function prepareForValidation($data, $index)
    {
        $bookCategory = BookCategory::where('name', $data['Kategori'])->first();

        if (!$bookCategory) {
            $bookCategory = BookCategory::create([
                'name' => $data['Kategori'],
                'created_by' => auth()->user()->id
            ]);

            $data['category_id'] = $bookCategory->id;
        } else {
            $data['category_id'] = $bookCategory->id;
        }

        return $data;
    }

    public function rules(): array
    {
        return [
            'Judul' => 'required',
            'Penulis' => 'required',
            'Penerbit' => 'required',
            'Tahun Terbit' => 'required',
            'Kategori' => 'required',
        ];
    }
}
