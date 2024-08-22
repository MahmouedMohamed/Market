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
        Schema::create('user_sub_types_translations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_sub_type_id');
            $table->foreign('user_sub_type_id')
                ->references('id')
                ->on('user_sub_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('locale');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->timeStamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_user_types_translations');
    }
};
