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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('characters')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $list = [
            1 => [1 => 'リュウ', 2 => '春麗'],
            2 => [101 => 'ソル', 102 => 'カイ']
        ];
        foreach ($list as $gameId => $characters) {
            foreach ($characters as $id => $character) {
                $model = new Character();
                $model->id = $id;
                $model->game_id = $gameId;
                $model->name = $character;
                $model->save();
            }
        }
    }
}