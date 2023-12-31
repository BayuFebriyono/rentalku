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
        Schema::create('pengrimans', function (Blueprint $table) {
            $table->id();
            $table->string('no_nota');
            $table->foreign('no_nota')->references('no_nota')->on('transaksis')->onDelete('cascade');
            $table->foreignId('karyawan_id');
            $table->integer('komisi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengrimans');
    }
};
