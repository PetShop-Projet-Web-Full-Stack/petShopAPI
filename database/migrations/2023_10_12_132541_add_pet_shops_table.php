<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pet_shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string("zipcode", 5);
            $table->string("city");
            $table->string("phone", 15);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet_shops');
    }
};
