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
        Schema::create('m_label_address', function (Blueprint $table) {
            $table->string('label_id', 20)->primary();
            $table->string('label_name', 25);
            $table->string('description', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_label_address');
    }
};
