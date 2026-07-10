<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('minat_data', function (Blueprint $table) {
            $table->id();
            $table->string('category');   // sembako, simpan_pinjam, dst
            $table->smallInteger('year');
            $table->tinyInteger('month'); // 1-12
            $table->integer('anggota')->default(0);
            $table->integer('mitra')->default(0);
            $table->string('status')->default('approved'); // approved | pending
            $table->integer('draft_anggota')->nullable();
            $table->integer('draft_mitra')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('minat_data');
    }
};
