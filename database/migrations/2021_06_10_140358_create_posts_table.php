<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->mediumText('title');
            $table->mediumText('slug');
            $table->mediumText('excerpt');
            $table->string('photo');
            $table->longText('content');
            $table->mediumText('meta_title');
            $table->mediumText('meta_keyword');
            $table->mediumText('meta_description');
            $table->enum('statue',['publiched','pending']);
            $table->unsignedBigInteger('category_id')->unsigned();
            $table->foreign('category_id')
                    ->references('id')->on('categories')
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
        Schema::dropIfExists('posts');
    }
}
