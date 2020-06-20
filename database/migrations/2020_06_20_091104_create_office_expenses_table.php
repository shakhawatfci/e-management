<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('office_expense_head_id');
            $table->integer('user_id');
            $table->string('month');
            $table->string('date');
            $table->double('amount');
            $table->string('document')->nullable();
            $table->text('doucment_link')->nullable();
            $table->text('note');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('office_expenses');
    }
}
