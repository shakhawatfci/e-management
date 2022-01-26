<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorConcernsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_concerns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->comment('stored by admin');
            $table->string('email',100)->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->text('available_equipment')->nullable();
            $table->string('introduce_by')->nullable();
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
        Schema::dropIfExists('vendor_concerns');
    }
}
