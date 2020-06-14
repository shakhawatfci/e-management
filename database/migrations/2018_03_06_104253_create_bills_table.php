<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('claim_id');
            $table->integer('project_id');
            $table->integer('vendor_id');
            $table->integer('equipement_id');
            $table->string('month');
            $table->string('bill_date');
            $table->string('bill_no');
            $table->string('bill_to');
            $table->text('subject');
            $table->string('bill_by');
            $table->string('designation');
            $table->string('company');
            $table->string('reg_no')->nullable;
            $table->string('tin_no')->nullable;
            $table->string('bank_name')->nullable;
            $table->string('bank_ac_name')->nullable;
            $table->string('bank_ac')->nullable;
            $table->string('bank_branch')->nullable;
            $table->string('bank_routing')->nullable;
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
        Schema::dropIfExists('bills');
    }
}
