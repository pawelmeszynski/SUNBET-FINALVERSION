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
        Schema::create('predicts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('match_id')->nullable();
            $table->integer('home_team_goals')->nullable();
            $table->integer('away_team_goals')->nullable();
            $table->unsignedBigInteger('competition_id')->nullable()->default(2000);

            $table->foreign('competition_id')->references('id')->on('competitions');
            $table->foreign('match_id')->references('id')->on('schedules');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('predicts');
    }
};
