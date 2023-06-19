<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Enum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('ticket_id')->nullable();

            $table->string('name_article');
            $table->integer('quantity');
            $table->integer('unity_price');
            $table->integer('total');
            $table->string('notice')->nullable();
            $table->string('notice_doc')->nullable(); 
            $table->string('garantie')->nullable();
            $table->string('tuto')->nullable();
            $table->string('reparation')->nullable();
            $table->string('other_model')->nullable();
            $table->string('revente')->nullable();
            $table->string('categories')->Enum('Shopping', 'Restaurant', 'Appareils', 'Epicerie', 'Autres')->nullable();

            $table->index(["user_id"], "fk_user_articles");
            $table->index(["ticket_id"], "fk_articles_tickets");

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('ticket_id')->references('id')->on('tickets');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
