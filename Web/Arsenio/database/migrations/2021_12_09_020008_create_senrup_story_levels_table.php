<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSenrupStoryLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senrup_story_levels', function (Blueprint $table) {
            $table->id('level_id');
            $table->unsignedBigInteger('story_id');
            $table->boolean('open_status');
            $table->string('title');
            $table->boolean('level_finished');
            $table->unsignedBigInteger('enemy_id');
            $table->timestamps();
        });

        Schema::table('senrup_story_levels', function (Blueprint $table){
            $table->foreign('story_id')
            ->references('story_id')->on('senrup_stories')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('enemy_id')
            ->references('enemy_id')->on('senrup_enemies')
            ->onDelete('cascade')
            ->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('senrup_story_levels');
    }
}
