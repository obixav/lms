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
        //['product_category_id','name','price','available','description','information',
    //'vendor_information','discount','is_featured','sku'];
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('product_category_id');
            $table->string('name');
            $table->decimal('price',10,2);
            $table->integer('available');
            $table->text('description')->nullable();
            $table->text('information')->nullable();
            $table->text('vendor_information')->nullable();
            $table->decimal('discount',8,2)->default(0);
            $table->integer('is_featured');
            $table->string('sku');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
