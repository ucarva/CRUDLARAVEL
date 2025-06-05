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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            //relacion de mis tablas
            $table->foreignId('student_id')
                ->constrained()
                ->onDelete('cascade');
            //relacion de mis tablas
            $table->foreignId('subject_id')
                ->constrained()
                ->onDelete('cascade');
            $table->decimal('grade', 5, 2); // hasta 999.99
            $table->string('observation')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
