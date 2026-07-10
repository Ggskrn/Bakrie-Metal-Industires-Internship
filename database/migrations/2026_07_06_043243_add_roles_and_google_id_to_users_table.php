<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Cek apakah kolom 'role' sudah ada, jika belum tambahkan
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->enum('role', ['admin', 'kepala', 'public'])->default('public');
            });
        }

        // Cek apakah kolom 'google_id' sudah ada, jika belum tambahkan
        if (!Schema::hasColumn('users', 'google_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('google_id')->nullable()->unique();
            });
        }
    }

    public function down()
    {
        // Hapus kolom hanya jika ada
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
            if (Schema::hasColumn('users', 'google_id')) {
                $table->dropColumn('google_id');
            }
        });
    }
};