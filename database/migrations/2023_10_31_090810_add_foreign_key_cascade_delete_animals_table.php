<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('animals', function (Blueprint $table) {
            $table->dropConstrainedForeignId('race_id');
            $table->dropConstrainedForeignId('pet_shop_id');
            $table->dropConstrainedForeignId('medias_id');
        });

        Schema::table('races', function (Blueprint $table) {
            $table->dropConstrainedForeignId('species_id');
        });

        Schema::table('species', function (Blueprint $table) {
            $table->unique(['name']);
        });

        Schema::table('animals', function (Blueprint $table) {
            $table->foreignId('race_id')->after('date_of_birth')->constrained()->cascadeOnDelete();
            $table->foreignId('pet_shop_id')->constrained()->cascadeOnDelete();
            $table->foreignId('medias_id')->nullable()->constrained()->cascadeOnDelete();
        });

        Schema::table('races', function (Blueprint $table) {
            $table->foreignId('species_id')->after('id')->constrained()->cascadeOnDelete();
            $table->unique(['species_id', 'name']);
        });
    }

    public function down(): void
    {
        Schema::table('animals', function (Blueprint $table) {
            $table->dropConstrainedForeignId('race_id');
            $table->dropConstrainedForeignId('pet_shop_id');
            $table->dropConstrainedForeignId('medias_id');
        });

        Schema::table('races', function (Blueprint $table) {
            $table->dropConstrainedForeignId('species_id');
            $table->dropUnique(['species_id', 'name']);
        });

        Schema::table('species', function (Blueprint $table) {
            $table->dropUnique(['name']);
        });

        Schema::table('animals', function (Blueprint $table) {
            $table->foreignId('race_id')->constrained();
            $table->foreignId('pet_shop_id')->constrained();
            $table->foreignId('medias_id')->nullable()->constrained();
        });

        Schema::table('races', function (Blueprint $table) {
            $table->foreignId('species_id')->after('id')->constrained();
        });
    }
};
