<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_type_id');
            $table->foreignId('user_id');
            $table->string('customer_name');
            $table->string('month');
            $table->string('date');
            $table->double('profit');
            $table->text('note');
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
        Schema::dropIfExists('equipment_sales');
    }
}
