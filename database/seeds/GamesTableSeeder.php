<?php

use Illuminate\Database\Seeder;
use App\Model\Game;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = ['Street Fighter V', 'Guilty Gear Xrd'];
        foreach ($games as $game) {
            $model = new Game();
            $model->name = $game;
            $model->save();
        }
    }
}
