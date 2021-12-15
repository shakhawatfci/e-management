<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEquipmentExpenseInvoiceIdToEquipementExpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipement_expense', function (Blueprint $table) {
            $table->integer('equipment_expense_invoice_id');
            $table->string('payment_method')->nullable();
            $table->string('invoice_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipement_expense', function (Blueprint $table) {
            //
        });
    }
}
