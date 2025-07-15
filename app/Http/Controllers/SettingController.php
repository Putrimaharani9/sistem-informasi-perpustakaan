<?php

namespace App\Http\Controllers;

use App\DataTables\SettingDataTable;
use App\Http\Requests\SettingUpdateRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SettingDataTable $dataTable)
    {
        $pageTitle = 'Pengaturan';

        return $dataTable->render('pages.settings.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        $setting = Setting::find($setting->id);

        if (!$setting) {
            return redirect()->route('settings.index')->with('error', 'Data tidak ditemukan');
        }

        $pageTitle = 'Ubah Pengaturan';
        return view('pages.settings.edit', compact('pageTitle', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingUpdateRequest $request, Setting $setting)
    {
        $setting = Setting::find($setting->id);

        if (!$setting) {
            return redirect()->route('settings.index')->with('error', 'Data tidak ditemukan');
        }

        $setting->value = $request->value;
        $setting->save();

        return redirect('/settings?type=' . $setting->type)->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
