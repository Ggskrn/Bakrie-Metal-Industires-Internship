<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk_layanan_konten', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // sembako, simpan_pinjam, dst
            $table->string('title');
            $table->text('description');
            $table->text('syarat')->nullable();
            $table->string('harga_info')->nullable();
            $table->string('status')->default('approved'); // approved | pending
            $table->string('draft_title')->nullable();
            $table->text('draft_description')->nullable();
            $table->text('draft_syarat')->nullable();
            $table->string('draft_harga_info')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_layanan_konten');
    }
};
