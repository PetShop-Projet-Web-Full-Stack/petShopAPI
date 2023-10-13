<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->foreignId('species_id')->constrained();
            $table->string('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('races');
    }
};
