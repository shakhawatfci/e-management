<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_income', function (Blueprint $table) {
           $table->increments('id');
            $table->integer('project_id');
            $table->integer('vendor_id');
            $table->integer('equipement_id');
            $table->integer('claim_id');
            $table->string('month');
            $table->double('project_amount');
            $table->tinyInteger('payment_type');
            $table->string('payment_date')->nullable();
            $table->string('bank')->nullable();
            $table->string('account_no')->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('project_income');
    }
}
