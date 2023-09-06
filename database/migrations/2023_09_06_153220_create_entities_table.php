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



        Schema::create('m_entity', function (Blueprint $table) {
            $table->string('cif_id', 20)->primary();
            $table->string('entity_name', 255);
            $table->foreign('entity_type_id')->references('entity_type_id')->on('m_entity_type');
            $table->foreign('industry_id')->references('industry_id')->on('m_industry');
            $table->string('postal_code', 20)->nullable();
            $table->string('phone_number', 20);
            $table->string('city', 20);
            $table->text('description')->nullable();
            $table->string('address', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_entity');
    }
};
