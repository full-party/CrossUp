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
        $list = [
            // リュウ
            1 => [
                [1001, '5弱P', 30, 70, 0],
                [1002, '5中P', 60, 100, 0],
                [1003, '波動拳 弱', 60, 100, 0],
            ],
            // 春麗
            2 => [
                [2001, '5弱P', 30, 70, 0],
                [2002, '5中P', 60, 100, 0],
                [2003, '気功拳 弱', 70, 110, 10],
            ],
            // ソル
            101 => [
                [101001, '5P', 10, 0, 0],
                [101002, '5K', 28, 0, 0],
                [101003, 'ガンフレイム', 50, 0, 0],
            ],
            // カイ
            102 => [
                [102001, '5P', 10, 0, 0],
                [102002, '5K', 28, 0, 0],
                [102003, 'スタンエッジ', 60, 10, 10],
            ]
        ];
        foreach ($list as $characterId => $moves) {
            foreach ($moves as $move) {
                $model = new Move();
                $model->character_id = $characterId;
                $model->id = $move[0];
                $model->name = $move[1];
                $model->damage = $move[2];
                $model->stun = $move[3];
                $model->meter = $move[4];
                $model->save();
            }
        }
    }
}
