<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\DataTables\MembersDataTable;
use Illuminate\Support\Facades\Crypt;

class MemberFromController extends Controller
{
    public function index(MembersDataTable $dataTable)
    {
        $pageTitle = 'Data Anggota';
        return $dataTable->render('pages.members.index', compact('pageTitle'));
    }

    public function create()
    {
        $pageTitle = 'Tambah Anggota';
        return view('pages.members.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_anggota' => 'required|string|max:11|unique:members,id_anggota',
            'nama' => 'required|string|max:50',
            'nik' => 'required|digits:16',
            'email' => 'nullable|email',
            'alamat' => 'required|string|max:100',
            'nomor_telepon' => 'required|numeric',
            'status_anggota' => 'required|in:ASN,Non ASN',
        ]);

        Member::create([
            'id_anggota' => $request->id_anggota, // ✅ tidak dienkripsi
            'nama' => $request->nama,
            'nik' => Crypt::encryptString($request->nik),
            'email' => $request->email ? Crypt::encryptString($request->email) : null,
            'alamat' => Crypt::encryptString($request->alamat),
            'nomor_telepon' => Crypt::encryptString($request->nomor_telepon),
            'status_anggota' => $request->status_anggota, // ✅ enum tidak dienkripsi
        ]);

        return redirect()->route('members.create')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit($id)
{
    $pageTitle = 'Edit Anggota';
    $member = Member::findOrFail($id);

    try {
        $member->nik = Crypt::decryptString($member->nik);
        $member->email = $member->email ? Crypt::decryptString($member->email) : null;
        $member->alamat = Crypt::decryptString($member->alamat);
        $member->nomor_telepon = Crypt::decryptString($member->nomor_telepon);
    } catch (\Exception $e) {
        return back()->with('error', 'Data tidak dapat didekripsi. Silakan input ulang.');
    }

    return view('pages.members.edit', compact('member', 'pageTitle'));

}

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_anggota' => 'required|string|max:11|unique:members,id_anggota,' . $id,
            'nama' => 'required|string|max:50',
            'nik' => 'required|digits:16',
            'email' => 'nullable|email',
            'alamat' => 'required|string|max:100',
            'nomor_telepon' => 'required|numeric',
            'status_anggota' => 'required|in:ASN,Non ASN',
        ]);

        $member = Member::findOrFail($id);

        $member->update([
            'id_anggota' => $request->id_anggota, // ✅ tidak dienkripsi
            'nama' => $request->nama,
            'nik' => Crypt::encryptString($request->nik),
            'email' => $request->email ? Crypt::encryptString($request->email) : null,
            'alamat' => Crypt::encryptString($request->alamat),
            'nomor_telepon' => Crypt::encryptString($request->nomor_telepon),
            'status_anggota' => $request->status_anggota, // ✅ enum tidak dienkripsi
        ]);

        return redirect()->route('members.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
