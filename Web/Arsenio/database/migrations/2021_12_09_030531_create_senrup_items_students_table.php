<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSenrupItemsStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senrup_items_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('student_id');
            $table->integer('item_owned');
            $table->timestamps();
        });

        Schema::table('senrup_items_students', function (Blueprint $table){
            $table->foreign('item_id')
            ->references('item_id')->on('senrup_items')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('student_id')
            ->references('student_id')->on('senrup_students')
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
        Schema::dropIfExists('senrup_items_students');
    }
}
