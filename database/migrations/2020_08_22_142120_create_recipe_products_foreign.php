<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeProductsForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipe_products', function (Blueprint $table) {
            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipe_products', function (Blueprint $table) {
            $table->dropForeign('recipe_products_recipe_id_foreign');
            $table->dropForeign('recipe_products_product_id_foreign');
        });
    }
}
