<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table){
            $table->increments('id');
            $table->string('project_name');
            $table->string('project_location');
            $table->string('project_contact_person');
            $table->string('project_email')->nullable();
            $table->string('project_phone');
            $table->string('project_argument_with');
            $table->string('project_argument_date')->nullable();
            $table->string('project_start_date')->nullable();
            $table->string('project_country')->nullable();
            $table->string('project_file')->nullable();
            $table->text('project_file_links')->nullable();
            $table->text('project_details')->nullable();
            $table->tinyInteger('project_status')->default(1);
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
        Schema::dropIfExists('project');
    }
}
