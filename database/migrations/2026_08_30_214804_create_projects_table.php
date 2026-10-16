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
            $table->string('slug');
            $table->string('summary');
            $table->string('role');
            $table->string('audience');
            $table->string('completed_at');
            $table->text('challenge');
            $table->text('solution');
            $table->string('modality');
            $table->json('learning_objectives');
            $table->text('process');
            $table->string('seat_time')->nullable();
            $table->text('design_rationale');
            $table->string('demo_url')->nullable();
            $table->int('sort_order');
            $table->bool('is_published');
            $table->bool('featured');
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
