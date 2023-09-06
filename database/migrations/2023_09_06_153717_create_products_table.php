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

        Schema::create('m_products', function (Blueprint $table) {
            $table->string('product_id', 20)->primary();
            $table->foreign('category_id', 255)->references('category_id')->on('m_categories');
            $table->string('acc_id', 20)->references('acc_id')->on('m_accounts');
            $table->string('image_id', 20)->references('image_id')->on('m_images');
            $table->string('size_id', 20)->references('size_id')->on('m_sizes');
            $table->string('selection_id', 20)->references('selection_id')->on('m_selections');
            $table->string('product_name', 20);
            $table->text('description')->nullable();
            $table->integer('product_price', 11);
            $table->double('product_rate');
            $table->string('product_status', 2);
            $table->timestamp('created_at');
            $table->varchar('updated_at', 2);
            $table->double('product_tax');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_products');
    }
};
