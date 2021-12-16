<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSenrupStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senrup_students', function (Blueprint $table) {
            $table->id('student_id');
            $table->bigInteger('golds');
            $table->bigInteger('total_exp');
            $table->bigInteger('abyss_point');
            $table->unsignedBigInteger('exp_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('story_level_progress');
            $table->timestamps();
        });

        Schema::table('senrup_students', function(Blueprint $table){
            $table->foreign('exp_id')
            ->references('exp_id')->on('senrup_character_exps')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('story_level_progress')
            ->references('level_id')->on('senrup_story_levels')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('senrup_students');
    }
}
