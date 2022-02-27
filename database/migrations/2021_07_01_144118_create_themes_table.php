<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\theme;
class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->boolean('gmail')->default(0);
            $table->boolean('facebook')->default(0);
            $table->integer('property_view')->default(1);
            $table->integer('landing_page')->default(1);
            $table->timestamps();
        });

        $theme = new theme();
        $theme->save(); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('themes');
    }
}
