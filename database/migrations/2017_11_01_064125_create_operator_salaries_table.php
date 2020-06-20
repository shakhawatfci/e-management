<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperatorSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_salaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('operator_id');
            $table->string('month');
            $table->string('payment_date');
            $table->double('payment_amount');
            $table->tinyInteger('mode');
            $table->text('bank_note')->nullable();
            $table->text('bkash_note')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('salary_type')->default(1);
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
        Schema::dropIfExists('operator_salaries');
    }
}
