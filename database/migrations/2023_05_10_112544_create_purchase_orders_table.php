<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('id_purchaseorder')->unique();
            $table->date('tglCreate');
            $table->date('tglExp');
            $table->double('amount');
            $table->double('ppn');
            $table->double('gtotal');
            $table->string('note');
            $table->string('pricelist')->nullable();
            $table->foreignId('principal_id')->constrained('principals');
            $table->foreignId('user_id')->constrained('users');
            $table->enum('status', ['Waiting for Approval', 'Outstanding', 'Received', 'Approved', 'Rejected', 'Close']);
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
        Schema::dropIfExists('purchase_orders');
    }
}
