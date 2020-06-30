<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('month');
            $table->string('date');
            $table->double('salary_amount');
            $table->double('bonus')->nullable()->default(0);
            $table->text('bonus_reason')->nullable()->default('');
            $table->double('deduction')->nullable()->default(0);
            $table->text('deduction_reason')->nullable()->default('');
            $table->double('total_salary_amount');
            $table->text('salary_note')->nullable()->default('');
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
        Schema::dropIfExists('employee_salaries');
    }
}
