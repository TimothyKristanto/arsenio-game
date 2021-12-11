<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSenrupLevelsRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senrup_levels_rewards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('reward_id');
            $table->integer('reward_amount');
            $table->timestamps();
        });

        Schema::table('senrup_levels_rewards', function (Blueprint $table){
            $table->foreign('level_id')
            ->references('level_id')->on('senrup_story_levels')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('reward_id')
            ->references('reward_id')->on('senrup_rewards')
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
        Schema::dropIfExists('senrup_levels_rewards');
    }
}
