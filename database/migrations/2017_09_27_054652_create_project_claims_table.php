<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('bill_no')->nullable();
            $table->foreignId('assign_id');
            $table->foreignId('project_id');
            $table->foreignId('vendor_id');
            $table->foreignId('equipment_type_id');
            $table->foreignId('equipement_id');
            $table->foreignId('user_id');
            $table->foreignId('operator_id')->nullable()->default(0);
            $table->string('month');
            $table->string('date');
            $table->double('total_hour');
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
            $table->double('vendor_adjustment_payment')->nullable()->default(0);
            $table->double('project_payment')->nullable()->default(0);
            $table->double('project_adjustment_payment')->nullable()->default(0);
            $table->string('file')->nullable();
            $table->text('documents_link')->nullable();
            $table->tinyInteger('rate_status')->nullable()->default(1);
            $table->tinyInteger('payment_status')->nullable()->default(0);
            $table->tinyInteger('vendor_payment_status')->nullable()->default(0);
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
