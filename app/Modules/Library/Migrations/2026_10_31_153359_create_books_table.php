<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('isbn')->unique();
            $table->integer('tahun_terbit');
            $table->decimal('harga', 12, 2);
            $table->integer('stok')->default(0);

            // relasi ke tabel authors
            $table->foreignId('author_id')
                ->constrained('authors')
                ->onDelete('cascade');
                
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
