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
            $table->string('bill_no')->nullable();
            $table->integer('assign_id');
            $table->integer('project_id');
            $table->integer('vendor_id');
            $table->integer('equipment_type_id');
            $table->integer('equipement_id');
            $table->string('month');
            $table->string('date');
            $table->double('project_rate_per_hour');
            $table->double('vendor_rate_per_hour');
            $table->double('project_amount');
            $table->double('vendor_amount');
            $table->double('project_vat')->default(0)->nullable();
            $table->double('project_ait')->default(0)->nullable();
            $table->double('project_sup')->default(0)->nullable();
            $table->double('vendor_vat')->default(0)->nullable();
            $table->double('vendor_ait')->default(0)->nullable();
            $table->double('vendor_sup')->default(0)->nullable();
            $table->double('total_project_amount');
            $table->double('total_vendor_amount');
            $table->double('vendor_payment')->default(0);
            $table->double('vendor_adjustment_payment')->default(0);
            $table->double('project_payment')->default(0);
            $table->double('project_adjustment_payment')->default(0);
            $table->tinyInteger('rate_status')->default(1);
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
        Schema::dropIfExists('project_claim');
    }
}
