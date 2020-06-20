<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_assign', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->integer('equipment_type_id');
            $table->integer('vendor_id');
            $table->integer('equipement_id');
            $table->integer('user_id')->comment = "assigned by which employee or admin assinged it";
            $table->integer('operator_id')->nullabe()->default(0);
            $table->double('total_hour');
            $table->double('total_project_amount');
            $table->double('total_vendor_amount');
            $table->double('project_rate_per_hour');
            $table->double('vendor_rate_per_hour');
            $table->text('documents_link')->nullable();
            $table->string('assign_date')->nullable();
            $table->string('release_date')->nullable();
            $table->text('release_note')->nullable();
            $table->tinyInteger('release_status')->default(1)->comment = "1 not release 0 release";
            $table->tinyInteger('status')->default(1)->comment = "1 active or 0 not active";
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
        Schema::dropIfExists('car_assign');
    }
}
