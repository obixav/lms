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
        Schema::create('leave_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('workflow_id');
            $table->integer('annual_leave_id');
            $table->tinyInteger('uses_casual_leave');
            $table->tinyInteger('casual_leave_length');
            $table->tinyInteger('require_replacement_approval');
            $table->tinyInteger('include_holiday');
            $table->tinyInteger('include_weekend');
            $table->tinyInteger('can_request_allowance');
            $table->tinyInteger('probationer_applies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_settings');
    }
};
