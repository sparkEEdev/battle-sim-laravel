<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterGamesAddRoundsAndWinnerColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->unsignedInteger('round_count')->default(0)->after('status');
            $table->unsignedBigInteger('army_winner_id')->nullable()->after('round_count');
            $table->foreign('army_winner_id')->references('id')->on('armies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropForeign(['army_winner_id']);
            $table->dropColumn(['army_winner_id', 'round_count']);
        });
    }
}
