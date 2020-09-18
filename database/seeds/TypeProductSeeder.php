<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_products')->insert([
            [
                'name' => 'Default',
            ],
        ]);
    }
}
