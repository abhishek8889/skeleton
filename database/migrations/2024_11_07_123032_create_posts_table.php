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
            $table->string('title');
            $table->string('slug');
            $table->string('short_name');
            $table->foreignId('category_id')
                    ->constrained('categories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('author',100)->nullable();
            $table->string('image_name')->nullable();
            $table->string('excerpt')->nullable();
            $table->text('content');
            $table->tinyInteger('status')->nullable()->default(1)->comment('1:publish');
            $table->tinyInteger('type_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_tag', function (Blueprint $table) {
            $table->dropForeign('post_tag_post_id_foreign'); // Drop the foreign key constraint
        });
        Schema::dropIfExists('posts');
    }
};
