<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('to');
            $table->string('company');
            $table->text('address');
            $table->text('subject');
            $table->text('request');
            $table->text('terms');
            $table->text('name');
            $table->text('designation');
            $table->tinyInteger('status')->nullable()->default(0);
            $table->tinyInteger('is_mailed')->nullable()->default(0);
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
        Schema::dropIfExists('quotations');
    }
}
