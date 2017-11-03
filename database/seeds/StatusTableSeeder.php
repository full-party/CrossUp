<?php

use App\Model\Status;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('statuses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ゲームID => [ID => ステータス名]
        $data = [
            1 => [
                1 => 'COUNTER',
                2 => 'VT',
                3 => 'しゃがみ喰らい',
                4 => '持続当て'
            ],
            2 => [
                100 => 'COUNTER'
            ]
        ];

        foreach ($data as $gameId => $status) {
            foreach ($status as $id => $name) {
                $model = new Status();
                $model->id = $id;
                $model->game_id = $gameId;
                $model->name = $name;
                $model->save();
            }
        }
    }
}
