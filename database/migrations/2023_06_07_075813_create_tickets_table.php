<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('name_store');

            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('phone')->nullable();
            $table->string('number_ticket');
            $table->string('adresse')->nullable();
            $table->string('name_cashier');
            $table->integer('net');
            $table->integer('tva')->nullable();
            $table->integer('total_payable');

            $table->index(["user_id"], "fk_user_ticket");

            $table->foreign('user_id')->references('id')->on('users');

            $table->softDeletes();
            $table->timestamps();
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
