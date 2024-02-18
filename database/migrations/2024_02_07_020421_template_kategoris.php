<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('template_kategoris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_template'); 
            $table->unsignedBigInteger('id_kategori'); 
            $table->timestamps();

            $table->foreign('id_template')->references('id')->on('templates')->onDelete('cascade'); // Menggunakan onDelete('cascade') untuk kunci asing
            $table->foreign('id_kategori')->references('id')->on('kategoris')->onDelete('cascade'); // Menggunakan onDelete('cascade') untuk kunci asing
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_kategoris');
    }
};
