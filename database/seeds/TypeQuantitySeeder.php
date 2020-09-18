<?php

use Illuminate\Database\Seeder;

class TypeQuantitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_quantity')->insert([
            [
                'name' => 'Default',
            ],
        ]);
    }
}
