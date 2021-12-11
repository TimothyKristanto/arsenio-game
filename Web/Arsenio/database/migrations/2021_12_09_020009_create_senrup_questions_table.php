<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSenrupQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senrup_questions', function (Blueprint $table) {
            $table->id('question_id');
            $table->text('question');
            $table->string('correct_answer');
            $table->string('answer_b');
            $table->string('answer_c');
            $table->string('answer_d');
            $table->unsignedBigInteger('level_id');
            $table->timestamps();
        });

        Schema::table('senrup_questions', function (Blueprint $table){
            $table->foreign('level_id')
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
        Schema::dropIfExists('senrup_questions');
    }
}
