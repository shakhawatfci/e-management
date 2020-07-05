<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipementExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipement_expense', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->foreignId('vendor_id');
            $table->foreignId('equipment_type_id');
            $table->foreignId('equipement_id');
            $table->foreignId('equipment_expense_head_id');
            $table->string('month');
            $table->string('payment_date');
            $table->double('amount');
            $table->string('document')->nullable();
            $table->text('documents_link')->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('equipement_expense');
    }
}
