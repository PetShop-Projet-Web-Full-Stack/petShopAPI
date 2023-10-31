<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pet_shops', function (Blueprint $table) {
            $table->text('content')->nullable();
            $table->foreignId('medias_id')->nullable()->constrained();
            $table->unique(['name', 'address', 'zipcode']);
        });
    }

    public function down(): void
    {
        Schema::table('pet_shops', function (Blueprint $table) {
            $table->dropColumn('content');
            $table->dropForeign(['medias_id']);
            $table->dropUnique(['name', 'address', 'zipcode']);
        });
    }
};
