<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOperatorRatePerHourToProjectClaimTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_claim', function (Blueprint $table) {
            $table->double('operator_total_amount',8,6)->nullable();
            $table->double('operator_rate_per_hour',8,6)->nullable();
            $table->double('operator_payment',8,6)->nullable();
            $table->double('operator_adjustment_payment',8,6)->nullable();
            $table->tinyInteger('operator_payment_status')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_claim', function (Blueprint $table) {
            //
        });
    }
}
