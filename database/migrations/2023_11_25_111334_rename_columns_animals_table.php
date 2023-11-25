<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('animals', function (Blueprint $table) {
            $table->dropColumn([
                'activity_level',
                'living_space',
                'size',
                'socialization',
                'grooming_needs',
                'noise_level',
                'trainability',
                'outdoor_activity',
            ]);
        });

        Schema::table('animals', function (Blueprint $table) {
            $table->enum('activity_level', ['Haut', 'Medium', 'Bas']);
            $table->enum('living_space', ['Appartement', 'Maison']);
            $table->enum('size', ['Petit', 'Medium', 'Large']);
            $table->enum('socialization', ['Haut', 'Medium', 'Bas']);
            $table->enum('grooming_needs', ['Haut', 'Medium', 'Bas']);
            $table->enum('noise_level', ['Haut', 'Medium', 'Bas']);
            $table->enum('trainability', ['Haut', 'Medium', 'Bas']);
            $table->enum('outdoor_activity', ['Haut', 'Medium', 'Bas']);
        });
    }

    public function down(): void
    {
        Schema::table('animals', function (Blueprint $table) {
            $table->dropColumn([
                'activity_level',
                'living_space',
                'size',
                'socialization',
                'grooming_needs',
                'noise_level',
                'trainability',
                'outdoor_activity',
            ]);
        });
        Schema::table('animals', function (Blueprint $table) {
            $table->enum('activity_level', ['High', 'Medium', 'Low']);
            $table->enum('living_space', ['Apartment', 'House with Yard', 'Farm']);
            $table->enum('size', ['Small', 'Medium', 'Large']);
            $table->enum('socialization', ['High', 'Medium', 'Low']);
            $table->enum('grooming_needs', ['High', 'Medium', 'Low']);
            $table->enum('noise_level', ['High', 'Medium', 'Low']);
            $table->enum('trainability', ['High', 'Medium', 'Low']);
            $table->enum('outdoor_activity', ['High', 'Medium', 'Low']);
        });
    }
};
