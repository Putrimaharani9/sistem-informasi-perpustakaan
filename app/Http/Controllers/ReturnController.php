<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookReturnRequest;
use App\Models\BookCopy;
use App\Models\Loan;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Tambah Pengembalian';

        return view('pages.returns.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookReturnRequest $request)
    {
        $loan = Loan::where($request->only(['copy_id', 'member_id']))->latest()->first();

        $bookCopy = BookCopy::where([
            'id' => $loan->copy_id
        ])->first();

        if (!$loan || !$bookCopy) {
            return redirect()->back()->with('error', 'Peminjaman buku tidak ditemukan');
        }

        $loan->update([
            'is_returned' => true,
            'updated_at' => now(),
        ]);

        $bookCopy->update([
            'status' => BookCopy::AVAILABLE,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Berhasil melakukan pengembalian buku');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
