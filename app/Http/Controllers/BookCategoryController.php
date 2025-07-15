<?php

namespace App\Http\Controllers;

use App\DataTables\BookCategoriesDataTable;
use App\Http\Requests\StoreBookCategoryRequest;
use App\Models\BookCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BookCategoriesDataTable $dataTable)
    {
        $pageTitle = 'Data Kategori Buku';
        return $dataTable->render('pages.book-categories.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Tambah Kategori Buku';
        return view('pages.book-categories.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookCategoryRequest $request)
    {
        $data = $request->validated();

        try {
            BookCategory::create([
                ...$data,
                'created_by' => $request->user()->id
            ]);

            return redirect()->route('book-categories.index')->with('success', 'Berhasil menambahkan data baru');
        } catch (Exception $exception) {
            dd($exception);
            return redirect()->back()->with('error', 'Terjadi kesalahan pada server');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BookCategory $bookCategory)
    {
        return view('pages.book-categories.show', [
            'data' => $bookCategory
        ]);
    }

    public function edit(BookCategory $bookCategory)
    {
        return view('pages.book-categories.edit', [
            'data' => $bookCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBookCategoryRequest $request, BookCategory $bookCategory)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();
            $bookCategory->update($data);

            DB::commit();
            return redirect()->route('book-categories.index')->with('success', 'Berhasil memperbarui data');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi kesalahan pada server');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookCategory $bookCategory)
    {
        try {
            DB::beginTransaction();
            $bookCategory->delete();

            DB::commit();
            return redirect()->route('book-categories.index')->with('success', 'Berhasil memperbarui data');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi kesalahan pada server');
        }
    }
}
