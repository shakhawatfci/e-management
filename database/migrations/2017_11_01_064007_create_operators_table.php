<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_type_id')->nullable();
            $table->foreignId('vendor_id')->nullable();
            $table->foreignId('equipement_id')->nullable();
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('bkash_number')->nullable();
            $table->string('join_date')->nullable();
            $table->string('nid')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('file')->nullable();
            $table->string('documents_link')->nullable();
            $table->double('salary')->nullable()->default(0);
            $table->tinyInteger('operator_type')->default(0)->comment = "0 = own operator  1 = vendor operator";
            $table->tinyInteger('status')->default(1)->nullable();
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
        Schema::dropIfExists('operators');
    }
}
