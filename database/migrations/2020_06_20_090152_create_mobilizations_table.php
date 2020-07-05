<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobilizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->nullable()->default(0);
            $table->foreignId('equipment_type_id')->nullable()->default(0);
            $table->foreignId('project_id')->nullable()->default(0);
            $table->foreignId('equipment_id')->nullable()->default(0);
            $table->foreignId('user_id')->comment = "entired by";
            $table->string('month');
            $table->string('date');
            $table->string('destination_from');
            $table->string('destination_to');
            $table->double('project_given_amount');
            $table->double('lobaid_cost')->comment = "lobaid trailor or truck cost";
            $table->double('profit')->comment = "project given amount - lobaid cost";
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
        Schema::dropIfExists('mobilizations');
    }
}
