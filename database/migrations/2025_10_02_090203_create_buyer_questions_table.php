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
        Schema::create('buyer_questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('question_id')->unique();
            $table->unsignedInteger('product_id');
            $table->text('question');
            $table->text('answer')->nullable();
            $table->text('answer2')->nullable();
            $table->unsignedInteger('asked_by');
            $table->boolean('is_read')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buyer_questions');
    }
};
