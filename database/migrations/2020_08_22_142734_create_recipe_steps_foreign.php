<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeStepsForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipe_steps', function (Blueprint $table) {
            $table->foreign('recipe_id')->references('id')->on('recipes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipe_steps', function (Blueprint $table) {
            $table->dropForeign('recipe_steps_recipe_id_foreign');
        });
    }
}
