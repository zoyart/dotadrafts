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
        Schema::create('tempos', function (Blueprint $table) {
            $table->id();
            $table->string('hero_name');
            $table->integer('matches');
            $table->string('early_duration');
            $table->string('middle_duration');
            $table->string('late_duration');
            $table->float('early_winrate');
            $table->float('middle_winrate');
            $table->float('late_winrate');
            $table->float('gradient');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tempos');
    }
};
