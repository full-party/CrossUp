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

        $data = new SplFileObject('database/seeds/data/character.csv');
        $data->setFlags(SplFileObject::READ_CSV);

        foreach ($data as $index => $line) {
            if ($index > 0) {
                $model = new Character();
                $model->id = $line[1];
                $model->game_id = $line[0];
                $model->name = $line[2];
                $model->save();
            }
        }
    }
}