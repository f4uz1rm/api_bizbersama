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
        Schema::create('m_color', function (Blueprint $table) {
            $table->string('color_id', 20);
            $table->string('sub_color_id', 255);
            $table->string('color_name', 20);
            $table->timestamps();

            $table->primary(['color_id', 'sub_color_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_color');
    }
};
