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
        $this->call(GamesTableSeeder::class);
        $this->call(CharactersTableSeeder::class);
        $this->call(MovesTableSeeder::class);
        $this->call(StatusTableSeeder::class);
    }
}