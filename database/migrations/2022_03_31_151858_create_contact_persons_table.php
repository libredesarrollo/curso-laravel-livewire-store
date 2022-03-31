<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_persons', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('surname', 80);
            $table->foreignId('contact_general_id')->onDelete('cascade');
            $table->enum('choices', ['adverd', 'post','course','movie','other']);
            $table->string('other', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_persons');
    }
};
