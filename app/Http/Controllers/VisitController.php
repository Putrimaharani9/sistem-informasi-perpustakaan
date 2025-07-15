<?php

namespace App\Http\Controllers;

use App\DataTables\VisitsDataTable;
use App\Http\Requests\VisitStoreRequest;
use App\Models\Member;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VisitsDataTable $dataTable)
    {
        $pageTitle = 'Data Kunjungan';
        return $dataTable->render('pages.visits.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Tambah Kunjungan';

        return view('pages.visits.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VisitStoreRequest $request)
    {
        Visit::create([
            'member_id' => $request->member_id,
        ]);

        return redirect()->route('visits.create')->with('success', 'Berhasil menambahkan data baru');
    }

    /**
     * Display the specified resource.
     */
    public function show(Visit $visit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visit $visit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visit $visit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visit $visit)
    {
        //
    }
}
