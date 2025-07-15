<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookCopyRequest;
use App\Imports\BookCopiesImport;
use App\Models\Book;
use App\Models\BookCopy;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class BookCopyController extends Controller
{
    /**
     * Show create form
     */
    public function create(Book $book)
    {
        $pageTitle = 'Tambah Salinan ' . $book->title;
        return view('pages.books.copies.create', [
            'parent' => $book,
            'pageTitle' => $pageTitle
        ]);
    }

    /**
     * Store data
     */
    public function store(Book $book, StoreBookCopyRequest $request)
    {
        $data = $request->validated();

        try {
            BookCopy::create([
                ...$data,
                'book_id' => $book->id,
                'created_by' => $request->user()->id
            ]);

            return redirect()->route('book.show', $book->id)->with('success', 'Data berhasil ditambahkan');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', 'Terjadi kesalahan pada server');
        }
    }

    /**
     * Destroy data
     */
    public function destroy(Book $book, BookCopy $copy)
    {
        try {
            DB::beginTransaction();
            $copy->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil menghapus data');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi kesalah pada server');
        }
    }

    /**
     * Get data via ajx
     */
    public function ajax_get(Request $request)
    {
        $data = BookCopy::with('book')
            ->when($request->search, function ($query, String $search) {
                $query->where('code', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('book', function ($query) use ($search) {
                        $query->where('title', 'LIKE', '%' . $search . '%');
                    });
            })
            ->paginate(15);

        return response()->json($data);
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
            Excel::import(new BookCopiesImport, $file);
            return redirect()->back()->with('success', 'Berhasil mengimport data');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
