<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOperatorTotalAmountToCarAssignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_assign', function (Blueprint $table) {
            $table->double('operator_total_amount',8,2)->nullable();
            $table->double('operator_rate_per_hour',8,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_assign', function (Blueprint $table) {
            //
        });
    }
}
