<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->mediumIncrements('id_client');
            $table->string('name', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->string('address', 255);
            $table->string('email_verified_at', 255)->nullable();
            $table->string('remember_token', 255)->nullable();
            $table->decimal('order', 8, 2);
            $table->boolean('active');
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
        Schema::dropIfExists('clients');
    }
}