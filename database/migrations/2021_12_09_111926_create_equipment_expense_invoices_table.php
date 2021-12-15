<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentExpenseInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_expense_invoices', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('equipement_expense_id')->constrained();
            $table->foreignId('project_id');
            $table->foreignId('vendor_id');
            $table->foreignId('equipment_type_id');
            $table->foreignId('equipement_id');
            $table->string('month');
            $table->string('payment_date');
            $table->string('invoice_no')->nullable();
            $table->string('payment_method')->nullable();
            $table->double('total_amount');
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
        Schema::dropIfExists('equipment_expense_invoices');
    }
}
