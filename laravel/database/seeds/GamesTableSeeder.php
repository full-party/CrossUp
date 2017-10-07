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
        $games = [1 => 'Street Fighter V', 2 => 'Guilty Gear Xrd'];
        foreach ($games as $id => $game) {
            $model = new Game();
            $model->id = $id;
            $model->name = $game;
            $model->save();
        }
    }
}
