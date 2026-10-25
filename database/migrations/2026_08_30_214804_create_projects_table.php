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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('summary');
            $table->string('role');
            $table->string('audience');
            $table->string('completed_at');
            $table->text('challenge');
            $table->text('solution');
            $table->string('modality');
            $table->text('learning_objectives');
            $table->text('process');
            $table->string('seat_time')->nullable();
            $table->text('design_rationale');
            $table->string('demo_url')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_published')->default(false);
            $table->boolean('featured')->default(false);
            $table->text('reflection')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
