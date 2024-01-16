<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjustStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjust_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('id_adjStock')->unique();
            $table->foreignId('id_inventory')->constrained('inventories');
            $table->foreignId('id_user')->constrained('users');
            $table->integer('qty');
            $table->string('note');
            $table->enum('status', ['Adjust In', 'Adjust Out']);
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
        Schema::dropIfExists('adjust_stocks');
    }
}
