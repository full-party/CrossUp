<?php

use Illuminate\Database\Seeder;
use App\Model\Character;

class CharactersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            1 => ['リュウ', '春麗'],
            2 => ['ソル', 'カイ']
        ];
        foreach ($list as $gameId => $characters) {
            foreach ($characters as $character) {
                $model = new Character();
                $model->game_id = $gameId;
                $model->name = $character;
                $model->save();
            }
        }
    }
}
