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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('length');
            $table->text('absence_doc')->nullable();
            $table->integer('leave_type_id');
            $table->integer('replacement_id');
            $table->integer('requested_allowance');
            $table->integer('status');
            $table->text('reason');
            $table->integer('workflow_id');
            $table->timestamp('deleted_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
