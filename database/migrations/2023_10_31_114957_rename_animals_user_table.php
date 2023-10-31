<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('animals_user', 'animals_users');
    }

    public function down(): void
    {
        Schema::rename('animals_users', 'animals_user');
    }
};
