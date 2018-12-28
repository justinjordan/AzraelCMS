<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditorSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('editor_settings')) {
            Schema::create('editor_settings', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
            });
        }

        Schema::table('editor_settings', function (Blueprint $table) {
            $table->integer('user_id');
            $table->string('theme');
            $table->string('keymap');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('editor_settings');
    }
}
