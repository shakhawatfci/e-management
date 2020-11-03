<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id');
            $table->string('equipment_description');
            $table->double('equipment_rate')->nullable()->default(0);
            $table->string('equipment_unit')->nullable()->default('Month');
            $table->double('equipment_qty')->nullable()->default(0);
            $table->double('total_equipment_amount')->nullable()->default(0);
            $table->string('operator_description');
            $table->double('operator_rate')->nullable()->default(0);
            $table->string('operator_unit')->nullable()->default('Day');
            $table->double('operator_qty')->nullable()->default(0);
            $table->double('total_operator_amount')->nullable()->default(0);
            $table->string('mobilization_description')->nullable()->default('');
            $table->string('demobilization_description')->nullable()->default('');
            $table->string('demobilization_amount')->nullable()->default('');
            $table->string('demobilization_amount')->nullable()->default('');
            $table->tinyInteger('status')->nullable()->default(1);
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
        Schema::dropIfExists('quotation_histories');
    }
}
