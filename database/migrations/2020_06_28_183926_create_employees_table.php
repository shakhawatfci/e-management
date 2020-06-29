<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            // password will save it user table along with name and email 
            $table->string('phone')->nullable();
            $table->string('designation')->nullable();
            $table->string('date_of_birth');
            $table->string('date_of_joining');
            $table->string('date_of_leaving')->nullable()->default('');
            $table->string('image')->nullable()->default('');
            $table->text('address')->nullable()->default('');
            $table->double('salary')->nullable()->default(0);
            $table->text('emargency_contact')->nullable()->default('');
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
        Schema::dropIfExists('employees');
    }
}
