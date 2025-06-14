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
        Schema::create('toplists', function (Blueprint $table) {
           $table->id();
        $table->string('country_code', 2)->nullable(); // ISO-2 or null for default
        $table->json('brand_ids'); // Array of brand IDs as JSON
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toplists');
    }
};
