<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_claim', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assign_id');
            $table->integer('project_id');
            $table->integer('vendor_id');
            $table->integer('equipement_id');
            $table->string('month');
            $table->double('project_hour');
            $table->double('project_amount');
            $table->double('vat')->nullable();
            $table->double('rate_given')->nullable();
            $table->double('ait')->nullable();
            $table->double('sup')->nullable();
            $table->double('operator_amount')->nullable();
            $table->double('operator_rate')->nullable();
             $table->double('fuel_amount')->nullable();
            $table->double('fuel_rate')->nullable();
            $table->tinyInteger('mob_type')->default(0);
            $table->double('mob_taken')->default(0);
            $table->double('mob_given')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('rate_status')->default(1);
            $table->double('payment')->default(0);
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
        Schema::dropIfExists('project_claim');
    }
}
