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
        Schema::create('daerahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('desa_id');
            $table->unsignedBigInteger('kelompok_id');
            $table->string('name');
            $table->string('dapukan');
            $table->timestamps();

            $table->foreign('desa_id')->references('id')->on('desas');
            $table->foreign('kelompok_id')->references('id')->on('kelompoks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daerahs');
    }
};
