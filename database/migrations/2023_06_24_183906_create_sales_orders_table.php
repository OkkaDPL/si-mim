<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->string('id_salesOrder');
            $table->string('po');
            $table->foreignId('employee_id')->constrained('employees');
            $table->foreignId('warehouse_id')->constrained('warehouses');
            $table->foreignId('bin_id')->constrained('bins');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('customer_id')->constrained('customers');
            $table->string('sih')->nullable();
            $table->string('pofile')->nullable();
            $table->date('tanggal');
            $table->enum('status', ['Process', 'On Delivery', 'Invoiced']);
            $table->enum('salestype', ['Beli Putus', 'Konsinyasi']);
            $table->double('amount');
            $table->double('ppn');
            $table->double('gtotal');
            $table->string('note');
            $table->string('imgSih')->nullable();
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
        Schema::dropIfExists('sales_orders');
    }
}
