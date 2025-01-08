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
        Schema::create('course_mentors', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active');
            $table->string('user_id')->constrained()->cascadeOnDelete();
            $table->string('course_id')->constrained()->cascadeOnDelete();
            $table->text('about');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_mentors');
    }
};
