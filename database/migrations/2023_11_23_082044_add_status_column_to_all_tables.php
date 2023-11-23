<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('animals', function (Blueprint $table) {
            $table->boolean('status')->default(true);
        });
        Schema::table('medias', function (Blueprint $table) {
            $table->boolean('status')->default(true);
        });
        Schema::table('pet_shops', function (Blueprint $table) {
            $table->boolean('status')->default(true);
        });
        Schema::table('races', function (Blueprint $table) {
            $table->boolean('status')->default(true);
        });
        Schema::table('species', function (Blueprint $table) {
            $table->boolean('status')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('animals', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('medias', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('pet_shops', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('races', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('species', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
