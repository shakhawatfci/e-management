<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('project_claim_id');
            $table->integer('project_id');
            $table->integer('vendor_id');
            $table->integer('equipment_type_id');
            $table->integer('equipement_id');
            $table->integer('user_id');
            $table->string('month');
            $table->string('date');
            $table->double('amount');
            $table->text('note')->nullable()->comment = "payment related note such as bank info";
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
        Schema::dropIfExists('operator_payments');
    }
}
