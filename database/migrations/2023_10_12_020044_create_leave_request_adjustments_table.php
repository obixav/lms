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
        Schema::create('leave_request_adjustments', function (Blueprint $table) {
//            ['leave_request_id','date','adjuster_id','reason']
            $table->id();
            $table->integer('leave_request_id');
            $table->date('date');
            $table->integer('adjuster_id');
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_request_adjustments');
    }
};
