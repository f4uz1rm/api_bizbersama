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
  
        Schema::create('m_contact', function (Blueprint $table) {
            $table->string('contact_id', 25)->primary();
            $table->string('contact_title', 255);
            $table->text('description')->nullable();
            $table->string('acc_id', 25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_contact');
    }
};
