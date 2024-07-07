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
        Schema::create('checkup_results', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('checkup_id');
            $table->bigInteger('website_id');
            $table->boolean('passed')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkup_results');
    }
};
