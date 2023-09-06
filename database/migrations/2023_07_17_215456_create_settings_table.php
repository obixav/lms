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
        //['store_name','email','address','copyright','phone','facebook','instagram','maintenance_mode']
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('store_name');
            $table->string('email');
            $table->text('address');
            $table->string('copyright');
            $table->string('phone');
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->integer('maintenance_mode')->default(0);
            $table->decimal('tax_rate',8,2)->default(0);
            $table->text('big_announcement')->nullable();
            $table->string('small_announcement')->nullable();
            $table->string('discount_announcement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
