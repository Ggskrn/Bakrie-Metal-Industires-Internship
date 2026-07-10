<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'kepala', 'public'])->default('public');
            $table->string('google_id')->nullable()->unique();
            $table->string('password')->nullable()->change(); // biarkan nullable untuk public
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'google_id']);
        });
    }
};