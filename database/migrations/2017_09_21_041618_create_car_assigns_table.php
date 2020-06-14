<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_assign', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->integer('vendor_id');
            $table->integer('equipement_id');
            $table->double('total_hour');
            $table->double('amount');
            $table->double('rate_per_hour');
            $table->double('project_amount');
            $table->double('project_rate_per_hour');
            $table->string('operator_name')->nullable();
            $table->string('operator_phone')->nullable();
            $table->double('operator_hour')->nullable();
            $table->double('operator_price')->nullable();
            $table->double('operator_rate_per_hour')->nullable();
            $table->double('operator_project_amount')->nullable();
            $table->double('operator_project_rate')->nullable();
            $table->double('fuel_amount')->nullable();
            $table->double('fuel_rate_per_hour')->nullable();
            $table->string('assign_date')->nullable();
            $table->string('status')->default(1);
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
        Schema::dropIfExists('car_assign');
    }
}
