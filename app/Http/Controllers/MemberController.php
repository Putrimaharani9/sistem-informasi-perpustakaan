<?php

namespace App\Http\Controllers;

use App\DataTables\MembersDataTable;
use App\Http\Requests\StoreMemberRequest;
use App\Models\User;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MembersDataTable $dataTable)
    {
        $pageTitle = 'Data Anggota';
        return $dataTable->render('pages.members.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Tambah Anggota';
        return view('pages.members.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            $member = User::create(array_merge($data, [
                'password' => Hash::make($data['password']),
                'created_by' => $request->user()->id
            ]))->assignRole('member');

            // Upload profile picture
            if ($file = $request->file('profile_picture')) {
                $url = $file->storePubliclyAs('media', $file->hashName(), 'public');

                $member->update([
                    'profile_picture' => $url
                ]);
            }

            DB::commit();
            return redirect()->route('members.index')->with('success', 'Berhasil menambahkan data');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi kesalahan pada server');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $member)
    {
        $pageTitle = $member->name;
        return view('pages.members.show', [
            'data' => $member,
            'pageTitle' => $pageTitle
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $member)
    {
        $pageTitle = $member->name;
        return view('pages.members.edit', [
            'data' => $member,
            'pageTitle' => $pageTitle
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMemberRequest $request, User $member)
    {
        $data = $request->except('profile_picture');

        try {
            DB::beginTransaction();
            $member->update($data);

            // Upload profile picture
            if ($file = $request->file('profile_picture')) {
                $url = $file->storePubliclyAs('media', $file->hashName(), 'public');

                // Delete old file if exist
                if ($oldImage = $member->profile_picture) {
                    Storage::disk('public')->exists($oldImage) && Storage::disk('public')->delete($oldImage);
                }

                $member->update([
                    'profile_picture' => $url
                ]);
            }

            DB::commit();
            return redirect()->route('members.show', $member->id)->with('success', 'Berhasil memperbaru data');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan pada server');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User$member)
    {
        try {
            DB::beginTransaction();
            $member->delete();

            DB::commit();
            return redirect()->route('members.index')->with('success', 'Berhasil menghapus data');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }

    /**
     * Get paginated data via ajax
     */
    public function ajax_get(Request $request)
    {
        $data = User::role('member')->paginate(15);


        return response()->json($data);
    }
}
