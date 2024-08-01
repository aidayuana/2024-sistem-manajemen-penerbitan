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
        Schema::create('theme_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoryId')->references('id')->on('categories');
            $table->string('cover')->nullable();
            $table->string('name');
            $table->string('isbn')->nullable()->comment('di atur ketika mau publish');
            $table->date('dueDate');
            $table->integer('price');
            $table->text('description');
            $table->enum('status', ['draft', 'open', 'review', 'siap_publish', 'publish', 'close'])->default('draft');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('title_recommendations');
    }
};
