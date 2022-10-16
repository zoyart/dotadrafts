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
        Schema::create('matchups', function (Blueprint $table) {
            $table->integer('hero_id');
            $table->string('hero')->nullable();
            $table->integer('matchup_hero_id');
            $table->string('matchup_hero')->nullable();
            $table->integer('match_count');
            $table->string('vs')->nullable();
            $table->string('with')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matchups');
    }
};
