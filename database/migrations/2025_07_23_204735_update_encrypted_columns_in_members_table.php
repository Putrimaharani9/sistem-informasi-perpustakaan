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
            $table->string('nik', 255)->change();
            $table->string('email', 255)->change();
            $table->string('alamat', 255)->change();
            $table->string('nomor_telepon', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('nik', 16)->change();
            $table->string('email', 100)->change();
            $table->string('alamat', 100)->change();
            $table->string('nomor_telepon', 15)->change();
        });
    }
};
