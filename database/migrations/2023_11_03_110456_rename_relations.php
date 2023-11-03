<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('animals_users', function (Blueprint $table) {
            $table->renameColumn('animals_id', 'animal_id');
            $table->renameColumn('users_id', 'user_id');
        });

        Schema::table('animals', function (Blueprint $table) {
            $table->renameColumn('races_id', 'race_id');
            $table->renameColumn('pet_shops_id', 'pet_shop_id');
            $table->renameColumn('medias_id', 'media_id');
        });
    }

    public function down(): void
    {
        Schema::table('animals_users', function (Blueprint $table) {
            $table->renameColumn('animal_id', 'animals_id');
            $table->renameColumn('user_id', 'users_id');
        });

        Schema::table('animals', function (Blueprint $table) {
            $table->renameColumn('race_id', 'races_id');
            $table->renameColumn('pet_shop_id', 'pet_shops_id');
            $table->renameColumn('media_id', 'medias_id');
        });
    }
};
