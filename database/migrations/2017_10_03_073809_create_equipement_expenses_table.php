<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipementExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipement_expense', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->integer('vendor_id');
            $table->integer('equipement_id');
            $table->integer('expense_category_id');
            $table->string('month');
            $table->string('payment_date');
            $table->double('amount');
            $table->tinyInteger('payment_type');
            $table->string('bank')->nullable();
            $table->string('account_no')->nullable();
            $table->string('document')->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('equipement_expense');
    }
}
