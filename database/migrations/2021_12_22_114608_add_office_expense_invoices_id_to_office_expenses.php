<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOfficeExpenseInvoicesIdToOfficeExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('office_expenses', function (Blueprint $table) {
            $table->foreignId('office_expense_invoice_id');
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
        Schema::table('office_expenses', function (Blueprint $table) {
            //
        });
    }
}
