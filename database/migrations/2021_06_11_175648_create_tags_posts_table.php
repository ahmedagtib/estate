<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tag_id')->unsigned();
            $table->unsignedBigInteger('post_id')->unsigned();
            $table->foreign('tag_id')
                    ->references('id')->on('tags')
                    ->onDelete('cascade');
            $table->foreign('post_id')
                    ->references('id')->on('posts')
                    ->onDelete('cascade');  
                    $table->timestamp('created_at')->useCurrent();
                    $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags_posts');
    }
}
