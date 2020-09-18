<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanRecipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_recipe', function (Blueprint $table) {
            $table->foreignId('id_recipe');
            $table->foreignId('id_plan');

            $table->foreign('id_recipe')
                ->references('id')
                ->on('recipes');
            $table->foreign('id_plan')
                ->references('id')
                ->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_recipe', function (Blueprint $table) {
            $table->dropForeign('plan_recipe_id_recipe_foreign');
            $table->dropForeign('plan_recipe_id_plan_foreign');
        });

        Schema::dropIfExists('plan_recipe');
    }
}
