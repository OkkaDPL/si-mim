<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('goodreceipt_id')->constrained('good_receipts');
            $table->foreignId('part_id')->constrained('parts');
            $table->integer('qty');
            $table->foreignId('warehouse_id')->constrained('warehouses');
            $table->foreignId('lot_id')->constrained('lots');
            $table->foreignId('bin_id')->constrained('bins');
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
        Schema::dropIfExists('inventories');
    }
}
