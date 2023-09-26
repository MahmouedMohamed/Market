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
        Schema::create('wish_lists_items', function (Blueprint $table) {
            $table->string('wish_list_id');
            $table->string('product_id');
            $table->primary(['wish_list_id', 'product_id']);
            $table->timestamps();

            $table->foreign('wish_list_id')
                ->references('id')
                ->on('wish_lists')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_wishlists');
    }
};
