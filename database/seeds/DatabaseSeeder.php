<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypeRecipesSeeder::class);
        $this->call(TypeProductSeeder::class);
        $this->call(TypeQuantitySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RecipeSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
