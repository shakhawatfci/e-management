<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_claim_id');
            $table->foreignId('project_id');
            $table->foreignId('vendor_id');
            $table->foreignId('equipment_type_id');
            $table->foreignId('equipement_id');
            $table->foreignId('user_id');
            $table->string('month');
            $table->string('date');
            $table->double('amount');
            $table->text('note')->comment = "payment related note such as bank info";
            $table->tinyInteger('status');
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
        Schema::dropIfExists('project_payments');
    }
}
