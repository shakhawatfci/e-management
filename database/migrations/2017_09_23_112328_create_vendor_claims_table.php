<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_claim', function (Blueprint $table) {
           $table->increments('id');
            $table->integer('assign_id');
            $table->integer('project_id');
            $table->integer('vendor_id');
            $table->integer('equipement_id');
            $table->string('month');
            $table->double('vendor_hour');
            $table->double('vendor_amount');
            $table->double('rate_given')->nullable();
            $table->double('vat')->nullable();
            $table->double('ait')->nullable();
            $table->double('sup')->nullable();
            $table->double('operator_amount');
            $table->double('operator_rate');
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
        Schema::dropIfExists('vendor_claim');
    }
}
