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
        Schema::create('seller_custom_fields', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('shop_name');
            $table->string('shop_address');
            $table->double('shop_latitude')->nullable();
            $table->double('shop_longitude')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_custom_fields');
    }
};
