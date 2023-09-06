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
        Schema::create('m_unit', function (Blueprint $table) {
            $table->string('unit_id', 20);
            $table->string('sub_selection_id', 255);
            $table->string('select_name', 25);
            $table->timestamps();

            $table->primary(['unit_id', 'sub_selection_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_unit');
    }
};
