<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Member;
use Illuminate\Support\Facades\Crypt;

class MembersFixDoubleEncryption extends Command
{
    protected $signature = 'members:fix-double-encryption';
    protected $description = 'Decrypt double-encrypted fields and re-encrypt once';

    public function handle()
    {
        $this->info("Proses dimulai...");

        $members = Member::all();

        foreach ($members as $member) {
            try {
                // Ambil nilai asli dari DB (tanpa accessor decrypt)
                $rawNik = $member->getRawOriginal('nik');
                $rawEmail = $member->getRawOriginal('email');
                $rawAlamat = $member->getRawOriginal('alamat');
                $rawTelepon = $member->getRawOriginal('nomor_telepon');

                // Decrypt dua kali
                $nik = Crypt::decryptString(Crypt::decryptString($rawNik));
                $email = Crypt::decryptString(Crypt::decryptString($rawEmail));
                $alamat = Crypt::decryptString(Crypt::decryptString($rawAlamat));
                $telepon = Crypt::decryptString(Crypt::decryptString($rawTelepon));

                // Simpan ulang, model akan mengenkripsi lagi sekali
                $member->update([
                    'nik' => $nik,
                    'email' => $email,
                    'alamat' => $alamat,
                    'nomor_telepon' => $telepon,
                ]);

                $this->info("✅ Member {$member->id_anggota} diperbaiki");

            } catch (\Exception $e) {
                $this->warn("❌ Gagal dekripsi member {$member->id_anggota}: {$e->getMessage()}");
            }
        }

        $this->info("Proses selesai.");
    }
}
