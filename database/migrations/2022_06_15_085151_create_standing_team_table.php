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
        Schema::create('standing_team', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id')->references('id')->on('teams');

            $table->unsignedBigInteger('standing_id')->nullable();
            $table->foreign('standing_id')->references('id')->on('standings');

            $table->integer('position')->nullable();
            $table->integer('played_Games')->nullable();
            $table->string('form')->nullable();
            $table->integer('won')->nullable();
            $table->integer('draw')->nullable();
            $table->integer('lost')->nullable();
            $table->integer('points')->nullable();
            $table->integer('goals_For')->nullable();
            $table->integer('goals_Against')->nullable();
            $table->integer('goal_Difference')->nullable();



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
        Schema::dropIfExists('standing_team');
    }
};
