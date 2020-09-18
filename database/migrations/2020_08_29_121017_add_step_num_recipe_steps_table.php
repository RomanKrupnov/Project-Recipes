<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStepNumRecipeStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipe_steps', function (Blueprint $table) {
            $table->integer('step_num')
                ->unsigned()
                ->after('recipe_id');
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
            $table->dropColumn('step_num');
        });
    }
}
