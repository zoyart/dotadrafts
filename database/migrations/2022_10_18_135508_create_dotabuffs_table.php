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
        Schema::create('dotabuffs', function (Blueprint $table) {
            $table->integer('hero_id');
            $table->string('hero')->nullable();
            $table->string('matchup_hero')->nullable();
            $table->string('vs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dotabuffs');
    }
};
