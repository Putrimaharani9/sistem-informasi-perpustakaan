<?php

namespace App\Http\Controllers;

use App\DataTables\LoansDataTable;
use App\Http\Requests\StoreLoanRequest;
use App\Models\BookCopy;
use App\Models\Loan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LoansDataTable $dataTable)
    {
        $pageTitle = 'Data Peminjaman';
        return $dataTable->render('pages.loans.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Tambah Peminjaman';
        return view('pages.loans.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoanRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            Loan::create(array_merge($data, [
                'created_by' => $request->user()->id
            ]));

            // Update book copy status
            BookCopy::where([
                'id' => $data['copy_id']
            ])->firstOrFail()->update([
                'status' => BookCopy::UNAVAILABLE
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil melakukan transaksi peminjaman buku');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi kesalahn pada server');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
