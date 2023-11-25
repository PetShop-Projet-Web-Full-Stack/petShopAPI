<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('medias', function (Blueprint $table) {
            $table->dropColumn('extension');
            $table->dropColumn('type');
            $table->longText('content')->change();
        });
    }

    public function down(): void
    {
        Schema::table('medias', function (Blueprint $table) {
            $table->dropColumn('content');
            $table->enum('type', ['image', 'video'])->after('id')->nullable();
            $table->enum('extension', ['png', 'jpg', 'svg', 'jpeg', 'gif', 'mp4'])->nullable();
        });
    }
};
