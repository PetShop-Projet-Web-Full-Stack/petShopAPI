<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['Male', 'Female']);
            $table->date('date_of_birth');
            $table->foreignId('race_id')->constrained();
            $table->foreignId('pet_shop_id')->constrained();
            $table->foreignId('medias_id')->nullable()->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};