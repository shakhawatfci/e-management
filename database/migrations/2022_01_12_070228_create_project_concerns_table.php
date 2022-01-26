<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectConcernsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_concerns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->comment('stored by admin');
            $table->string('email',100)->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('project_name')->nullable();
            $table->string('project_location')->nullable();
            $table->text('reqired_equipment')->nullable();
            $table->string('reference_by')->nullable();
            $table->string('rating')->nullable()->comment('Excellent,Very Good,Good,Not Good,Bad');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('project_concerns');
    }
}
