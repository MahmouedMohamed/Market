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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->unsignedBigInteger('nationality_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('sub_type_id')->nullable();
            $table->tinyInteger('status');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamps();
            $table->timeStamp('deleted_at')->nullable();

            $table->foreign('type_id')
                ->references('id')
                ->on('user_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('sub_type_id')
                ->references('id')
                ->on('user_types');

            $table->foreign('nationality_id')
                ->references('id')
                ->on('nationalities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
