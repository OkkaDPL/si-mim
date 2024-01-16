<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodReceiptItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_receipt_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('goodReceipt_id')->constrained('good_receipts');
            $table->foreignId('part_id')->constrained('parts');
            $table->integer('qty');
            $table->foreignId('lot_id')->constrained('lots');
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
        Schema::dropIfExists('good_receipt_items');
    }
}
