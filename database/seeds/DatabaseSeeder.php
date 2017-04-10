<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BookSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(UserBookSeeder::class);
        $this->call(UserSeeder::class);
    }
}
