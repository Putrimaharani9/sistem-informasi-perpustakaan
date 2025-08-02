<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            // Ganti 'nip' jadi 'nik'
            $table->renameColumn('nip', 'nik');

            // Tambah kolom email
            $table->string('email')->nullable()->after('nama');

            // Hapus kolom terenkripsi
            $table->dropColumn(['encrypted_address', 'encrypted_phone']);
        });
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            // Rollback: kembalikan 'nik' ke 'nip'
            $table->renameColumn('nik', 'nip');

            // Hapus kolom email
            $table->dropColumn('email');

            // Tambahkan kembali kolom terenkripsi
            $table->text('encrypted_address')->nullable();
            $table->text('encrypted_phone')->nullable();
        });
        //
    }
};
