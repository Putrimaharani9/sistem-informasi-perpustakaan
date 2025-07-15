<?php

namespace App\Http\Controllers;

use App\DataTables\BookCopiesDataTable;
use App\DataTables\BooksDataTable;
use App\Http\Requests\StoreBookRequest;
use App\Imports\BooksImport;
use App\Models\Book;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    /**
     * Show book list
     */
    public function index(BooksDataTable $dataTable, Request $request)
    {
        $pageTitle = 'Data Buku';
        return $dataTable->render('pages.books.index', compact('pageTitle'));
    }

    /**
     * Show book detail
     */
    public function show(Book $book, BookCopiesDataTable $dataTable)
    {
        $pageTitle = 'Detail Buku ' . $book->name;
        return $dataTable->render('pages.books.show', [
            'data' => $book,
            'pageTitle' => $pageTitle
        ]);
    }

    /**
     * Show book detail
     */
    public function edit(Book $book, BookCopiesDataTable $dataTable)
    {
        $pageTitle = 'Edit Buku ' . $book->name;
        return $dataTable->render('pages.books.edit', [
            'data' => $book,
            'pageTitle' => $pageTitle
        ]);
    }


    /**
     * Show create form
     */
    public function create()
    {
        $pageTitle = 'Tambah Buku';
        return view('pages.books.create', compact('pageTitle'));
    }

    /**
     * Store data
     */
    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();
            $book = Book::create([
                ...$data,
                'created_by' => $request->user()->id
            ]);

            DB::commit();
            return redirect()->route('book.show', $book->id)->with('success', 'Data berhasil ditambahkan');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->route('book.index')->with('error', 'Terjadi kesalahan pada server');
        }

        return view('pages.books.create');
    }


    /**
     * Update data
     */
    public function update(StoreBookRequest $request, Book $book)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();
            $book->update($data);

            DB::commit();
            return redirect()->route('book.show', $book->id)->with('success', 'Berhasil memperbarui data');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi kesalahan pada server');
        }

        return view('pages.books.create');
    }

    /**
     * Destroy
     */
    public function destroy(Book $book)
    {
        try {
            DB::beginTransaction();
            $book->delete();

            DB::commit();
            return redirect()->route('book.index')->with('success', 'Berhasil menghapus data');
        } catch (Exception $exception) {
            return redirect()->back('book.index')->with('success', 'Terjadi kesalahan pada server');
        }
    }

    /**
     * Import data from excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('file');

        try {
            Excel::import(new BooksImport, $file);
            return redirect()->back()->with('success', 'Berhasil mengimport data');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
