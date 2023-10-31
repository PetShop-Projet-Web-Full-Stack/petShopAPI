<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('animals_user', function (Blueprint $table) {
            $table->foreignId('animals_id')->constrained()->onDelete('cascade');
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
            $table->unique(['animals_id', 'users_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals_user');
    }
};
