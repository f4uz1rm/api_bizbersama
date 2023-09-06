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
        Schema::create('m_image', function (Blueprint $table) {
            $table->string('image_id', 20);
            $table->string('sub_image_id', 255);
            $table->string('image_link', 255)->nullable();
            $table->timestamps();

            $table->primary(['image_id', 'sub_image_id']);
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_image');
    }
};
