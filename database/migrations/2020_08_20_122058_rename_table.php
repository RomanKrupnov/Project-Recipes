<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('reciples', 'recipes');

        Schema::rename('type_reciples', 'type_recipes');

        Schema::rename('reciple_products', 'recipe_products');

        Schema::rename('type_weight', 'type_quantity');

        Schema::rename('reciple_steps', 'recipe_steps');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('recipes', 'reciples');

        Schema::rename('type_recipes', 'type_reciples');

        Schema::rename('recipe_products', 'reciple_products');

        Schema::rename('type_quantity', 'type_weight');

        Schema::rename('recipe_steps', 'reciple_steps');
    }
}
