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
        //['project_category_id','budget','message','file','customer_id','preview_code','can_preview_request'];
        Schema::create('customer_design_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('project_category_id');
            $table->decimal('budget',10,2);
            $table->text('message');
            $table->integer('customer_id');
            $table->ulid('preview_code');
            $table->integer('quantity');
            $table->integer('can_preview_request');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_design_requests');
    }
};
