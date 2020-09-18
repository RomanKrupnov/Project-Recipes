<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReciplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reciples', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->foreignId('type_reciple');
            $table->string('author', 100)
                ->default('admin');
            $table->string('photo_head', 255);
            $table->integer('kkal')
                ->unsigned()
                ->nullable();
            $table->text('description');
            $table->integer('cooking_time')
                ->unsigned()
                ->nullable();
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
        Schema::dropIfExists('reciples');
    }
}
