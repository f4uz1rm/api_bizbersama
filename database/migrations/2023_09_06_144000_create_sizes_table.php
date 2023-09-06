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
        Schema::create('m_size', function (Blueprint $table) {
            $table->string('size_id', 20);
            $table->string('sub_size_id', 255);
            $table->string('size_name', 20);
            $table->timestamps();

            $table->primary(['size_id', 'sub_size_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_size');
    }
};
