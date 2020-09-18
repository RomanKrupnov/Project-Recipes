<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->renameColumn('type_reciple', 'type_recipe');
        });
        Schema::table('recipe_products', function (Blueprint $table) {
            $table->renameColumn('reciple_id', 'recipe_id');
        });
        Schema::table('recipe_products', function (Blueprint $table) {
            $table->renameColumn('weight', 'quantity');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('type_weight', 'type_quantity');
        });
        Schema::table('recipe_steps', function (Blueprint $table) {
            $table->renameColumn('reciple_id', 'recipe_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->renameColumn('type_recipe', 'type_reciple');
        });
        Schema::table('recipe_products', function (Blueprint $table) {
            $table->renameColumn('recipe_id', 'reciple_id');
        });
        Schema::table('recipe_products', function (Blueprint $table) {
            $table->renameColumn('quantity', 'weight');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('type_quantity', 'type_weight');
        });
        Schema::table('recipe_steps', function (Blueprint $table) {
            $table->renameColumn('recipe_id', 'reciple_id');
        });
    }
}
