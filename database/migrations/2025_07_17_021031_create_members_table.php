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
        Schema::create('members', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone_number');
        $table->string('address');
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->string('profile_picture')->nullable();
        $table->integer('created_by');
        $table->rememberToken();
        $table->timestamps();
        $table->text('encrypted_address')->nullable();
        $table->text('encrypted_phone')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
