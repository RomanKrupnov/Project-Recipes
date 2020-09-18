<?php

use Illuminate\Database\Seeder;

class TypeRecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_recipes')->insert([
            [
                'name' => 'Default',
            ],
        ]);
    }
}
