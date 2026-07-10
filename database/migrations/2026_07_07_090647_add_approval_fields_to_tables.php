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
        // Tambahkan kolom approval ke tabel stoks
        Schema::table('stoks', function (Blueprint $table) {
            $table->string('status')->default('approved'); // draft, pending, approved, rejected
            $table->integer('draft_qty')->nullable();
            $table->decimal('draft_price', 10, 2)->nullable();
            $table->string('draft_product_name')->nullable();
        });

        // Tambahkan kolom approval ke tabel beritas
        Schema::table('beritas', function (Blueprint $table) {
            $table->string('status')->default('approved'); // draft, pending, approved, rejected
            $table->string('draft_title')->nullable();
            $table->text('draft_content')->nullable();
            $table->string('draft_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stoks', function (Blueprint $table) {
            $table->dropColumn(['status', 'draft_qty', 'draft_price', 'draft_product_name']);
        });

        Schema::table('beritas', function (Blueprint $table) {
            $table->dropColumn(['status', 'draft_title', 'draft_content', 'draft_image']);
        });
    }
};
