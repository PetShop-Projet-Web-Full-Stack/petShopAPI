<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pet_shops', function (Blueprint $table) {
            $table->renameColumn('medias_id', 'media_id');
        });
    }

    public function down(): void
    {
        Schema::table('pet_shops', function (Blueprint $table) {
            $table->renameColumn('media_id', 'medias_id');
        });
    }
};
