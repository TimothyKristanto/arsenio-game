<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSenrupLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senrup_logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->string('table');
            $table->unsignedBigInteger('student_id');
            $table->text('log_desc');
            $table->string('log_path');
            $table->string('log_ip');
            $table->timestamps();
        });

        Schema::table('senrup_logs', function (Blueprint $table){
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
        Schema::dropIfExists('senrup_logs');
    }
}
