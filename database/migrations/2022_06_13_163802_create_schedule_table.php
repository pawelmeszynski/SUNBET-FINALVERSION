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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('competition_id')->nullable();
            $table->unsignedBigInteger('home_team_id')->nullable();
            $table->unsignedBigInteger('away_team_id')->nullable();
            $table->dateTime('utc_date')->nullable();
            $table->string('status')->nullable();
            $table->integer('matchday')->nullable();
            $table->string('stage')->nullable();
            $table->string('group')->nullable();
            $table->timestamp('last_updated_at')->nullable();
            $table->timestamps();
            $table->unsignedInteger('home')->default(0);
            $table->unsignedInteger('away')->default(0);
            $table->boolean('points_calculated')->default(false);

            $table->foreign('competition_id')->references('id')->on('competitions');
//            $table->foreign('home_team_id')->references('id')->on('teams');
//            $table->foreign('away_team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule');
    }
};
