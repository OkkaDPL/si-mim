<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('id_invoice')->unique();
            $table->foreignId('deliveryOrder_id')->constrained('delivery_orders', 'id');
            $table->foreignId('user_id')->constrained('users', 'id');
            // $table->double('amount');
            // $table->double('ppn');
            // $table->double('gtotal');
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
        Schema::dropIfExists('invoices');
    }
}
