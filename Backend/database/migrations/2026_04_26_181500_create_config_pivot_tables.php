<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('configs', function (Blueprint $table) {
            $table->dropForeign(['interior_option_id']);
            $table->dropColumn('interior_option_id');
            $table->dropForeign(['accessory_id']);
            $table->dropColumn('accessory_id');
        });

        Schema::create('config_interior_option', function (Blueprint $table) {
            $table->id();
            $table->foreignId('config_id')->constrained('configs')->cascadeOnDelete();
            $table->foreignId('interior_option_id')->constrained('interior__options')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('config_accessory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('config_id')->constrained('configs')->cascadeOnDelete();
            $table->foreignId('accessory_id')->constrained('accessories')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_accessory');
        Schema::dropIfExists('config_interior_option');

        Schema::table('configs', function (Blueprint $table) {
            $table->foreignId('interior_option_id')->nullable()->constrained('interior__options')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('accessory_id')->nullable()->constrained('accessories')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }
};
