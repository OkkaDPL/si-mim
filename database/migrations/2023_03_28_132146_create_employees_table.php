<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nama');
            $table->date('bod');
            $table->string('tlp');
            $table->foreignId('user_id')->constrained('users');
            $table->date('tgl_msk');
            $table->string('division')->nullable();
            // $table->foreignId('departement_id')->constrained('departements');
            // $table->enum('level', ['Super Admin', 'Management', 'Top', 'Staff']);
            // $table->foreignId('division_id')->constrained('divisions');
            $table->enum('status', ['Aktif', 'Tidak Aktif']);
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
        Schema::dropIfExists('employees');
    }
}
