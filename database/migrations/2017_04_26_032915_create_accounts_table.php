<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account', 12);
            $table->string('email', 255)->unique();
            $table->string('senha', 30);
            $table->string('nick', 20);
            $table->integer('donate');
            $table->integer('cargo');
            $table->integer('data');
            $table->enum('alteracao', ['s','n']);
            $table->string('Prg Secreta', 50);
            $table->string('Res Secreta', 50);
            $table->string('senha numerica', 10);
            $table->string('CaveCode', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
