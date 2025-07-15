<?php

namespace App\Http\Controllers;

use App\DataTables\StaffsDataTable;
use App\Http\Requests\StoreStaffRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StaffsDataTable $dataTable)
    {
        $pageTitle = 'Data Staff';
        return $dataTable->render('pages.staffs.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Tambah Staff';
        return view('pages.staffs.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStaffRequest $request)
    {
        $data = $request->except('profile_picture');

        try {
            DB::beginTransaction();

            $user = User::create([
                ...$data,
                'created_by' => $request->user()->id
            ])->assignRole('staff');

            // Handle upload profile picture
            if ($profilePicture = $request->file('profile_picture')) {
                $url = $profilePicture->storePubliclyAs('media', $profilePicture->hashName(), 'public');

                $user->update([
                    'profile_picture' => $url
                ]);
            }

            DB::commit();
            return redirect()->route('staffs.index')->with('success', 'Berhasil menambahkan data');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi kesalahan pada server');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $staff)
    {
        return view('pages.staffs.show', [
            'data' => $staff
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $staff)
    {
        return view('pages.staffs.edit', [
            'data' => $staff
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStaffRequest $request, User $user)
    {
        $data = $request->except('profile_picture');

        try {
            DB::beginTransaction();

            $user = User::create([
                ...$data,
                'created_by' => $request->user()->id
            ]);

            // Handle upload profile picture
            if ($profilePicture = $request->file('profile_picture')) {
                $url = $profilePicture->storePubliclyAs('media', $profilePicture->hashName(), 'public');

                // Delete old file if exist
                if ($oldImage = $user->profile_picture) {
                    Storage::disk('public')->exists($oldImage) && Storage::disk('public')->delete($oldImage);
                }

                $user->update([
                    'profile_picture' => $url
                ]);
            }

            DB::commit();
            return redirect()->route('staffs.index')->with('success', 'Berhasil memperbarui data');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi kesalahan pada server');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $staff)
    {
        try {
            DB::beginTransaction();
            $staff->delete();

            DB::commit();
            return redirect()->route('staffs.index')->with('success', 'Berhasil menghapus data');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalan pada server');
        }
    }
}
