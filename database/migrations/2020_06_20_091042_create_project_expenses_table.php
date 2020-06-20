<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_expense_head_id');
            $table->integer('project_id');
            $table->integer('user_id');
            $table->string('month');
            $table->string('date');
            $table->double('amount');
            $table->string('document')->nullable();
            $table->text('doucment_link')->nullable();
            $table->text('note');
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
        Schema::dropIfExists('project_expenses');
    }
}
