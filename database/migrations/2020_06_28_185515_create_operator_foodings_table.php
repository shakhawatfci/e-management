<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorFoodingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_foodings', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->nullable()->default(0);
            $table->integer('vendor_id')->nullable()->default(0);
            $table->integer('equipment_type_id')->nullable()->default(0);
            $table->integer('equipement_id')->nullable()->default(0);
            $table->integer('user_id')->nullable()->default(0);
            $table->integer('operator_id');
            $table->double('fooding_amount');
            $table->tinyInteger('status')->nullable()->status(1);
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
        Schema::dropIfExists('operator_foodings');
    }
}
