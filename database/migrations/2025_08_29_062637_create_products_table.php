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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')
                  ->nullable()
                  ->constrained('kategoris')
                  ->nullOnDelete();

            $table->string('image')->nullable(); // path gambar produk
            $table->string('title');             // judul / nama produk
            $table->text('description');         // deskripsi produk
            $table->decimal('price', 15, 2);     // harga (lebih aman decimal)
            $table->integer('stock');            // jumlah stok
            $table->boolean('is_active')->default(true); // status aktif/tidak

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
