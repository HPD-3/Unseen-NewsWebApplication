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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->string('title', 255);
            $table->text('description'); // short summary, not varchar

            $table->string('image_url')->nullable(); // cover image only

            $table->string('category', 100);
            $table->enum('type', ['news', 'feature', 'opinion', 'analysis']);

            $table->string('continent', 100)->index();
            $table->string('country', 100)->index();
            $table->string('language', 10)->index();

            $table->longText('content'); // IMPORTANT for Docs-like writing

            $table->unsignedBigInteger('views')->default(0);

            $table->string('author', 100);

            $table->boolean('is_trending')->default(false);

            $table->timestamp('published_at')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
