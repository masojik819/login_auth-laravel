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
            $table->string('judul');
            $table->foreignId('author_id')->constrained(
                table : 'users',
                indexName: 'post_author_id'
            );
            $table->foreignId('jenis_id')->constrained(
                table : 'jenis',
                indexName: 'post_jenis_id'
            );
            $table->string('slug');
            $table->text('isi');
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
