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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('games')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $games = [
            1 => ['Street Fighter V', '/img/logo/Street-Fighter-V.png'],
            2 => ['Guilty Gear Xrd', '/img/logo/Guilty-Gear-Xrd.png']
        ];
        foreach ($games as $id => $game) {
            $model = new Game();
            $model->id = $id;
            $model->name = $game[0];
            $model->logo = $game[1];
            $model->save();
        }
    }
}
