<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipement', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id');
            $table->integer('equipment_type_id');
            $table->string('eq_name');
            $table->string('eq_model');
            $table->string('eq_capacity')->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('eq_status')->default(1);
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
        Schema::dropIfExists('equipement');
    }
}
