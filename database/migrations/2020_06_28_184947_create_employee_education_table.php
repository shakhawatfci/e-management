<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_education', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('institute');
            $table->string('board');
            $table->string('degree');
            $table->string('passing_year');
            $table->string('result');
            $table->string('gpa');
            $table->tinyInteger('status')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_education');
    }
}
