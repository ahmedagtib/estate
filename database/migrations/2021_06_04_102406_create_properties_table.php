<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->mediumText('title')->nullable();
            $table->mediumText('metatitle')->nullable();
            $table->mediumText('metadescription')->nullable();
            $table->mediumText('metakeyword')->nullable();
            $table->mediumText('slug')->nullable();
            $table->string('propertytype')->nullable();
            $table->string('status')->nullable();
            $table->string('price')->nullable();
            $table->string('energy')->nullable();
            $table->string('ges')->nullable();
            $table->string('area')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('address')->nullable();
            $table->longText('description')->nullable();
            $table->string('buildon')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('rooms')->nullable();
            $table->string('garage')->nullable();
            $table->longText('features')->nullable();
            $table->json('photos')->nullable();
            $table->longText('thumbnails')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('poststatus')->nullable();
            $table->string('scrapurl')->nullable();
            $table->string('qcode')->nullable();
            $table->longText('body')->nullable();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')
            ->references('id')->on('cities')
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
        Schema::dropIfExists('properties');
    }
}
