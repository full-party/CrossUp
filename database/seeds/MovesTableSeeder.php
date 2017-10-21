<?php

use App\Model\Move;
use Illuminate\Database\Seeder;

class MovesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('moves')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = new SplFileObject('database/seeds/data/moves.csv');
        $data->setFlags(SplFileObject::READ_CSV);

        foreach ($data as $index => $line) {
            if ($index > 0) {
                $model = new Move();
                $model->character_id = $line[0];
                $model->id = $line[1];
                $model->name = $line[2];
                $model->damage = $line[3];
                $model->stun = $line[4];
                $model->meter = $line[5];
                $model->save();
            }
        }
    }
}
