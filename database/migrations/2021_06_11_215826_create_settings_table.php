<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use  App\Models\Setting;
class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('button_search_form')->nullable();
            $table->string('logo')->nullable();
            $table->mediumText('hero_title')->nullable();
            $table->longText('hero_content')->nullable();
            $table->longText('find_by_locations')->nullable();
            $table->string('footer_title')->nullable();
            $table->string('footer_content')->nullable();
            $table->string('andriod_app')->nullable();
            $table->longText('media')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('adress')->nullable();
            $table->string('website')->nullable();
            $table->string('follow_title')->nullable();
            $table->string('contact_title')->nullable();
            $table->longText('contact_content')->nullable();
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('meta_keyword')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
        $setting = new Setting();
        $setting->save(); 

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
