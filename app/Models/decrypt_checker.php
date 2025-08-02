<?php
use App\Models\Member;
use Illuminate\Support\Facades\Crypt;

$members = Member::all();

foreach ($members as $member) {
    $errors = [];

    foreach (['email', 'nik', 'alamat', 'nomor_telepon'] as $field) {
        try {
            Crypt::decryptString($member->$field);
        } catch (\Exception $e) {
            $errors[] = $field;
        }
    }

    if (!empty($errors)) {
        echo "ID Anggota: {$member->id_anggota}, Nama: {$member->nama}, Kolom error: " . implode(', ', $errors) . "\n";
    }
}
