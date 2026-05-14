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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->foreignId('institution_id')->constrained();

            $table->foreignId('category_id')->constrained();

            $table->string('title');

            $table->text('description');

            $table->string('location_found');

            $table->string('contact_phone');

            $table->date('date_found');

            $table->string('photo_path')->nullable();

            $table->enum('status', ['active', 'reunited'])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
