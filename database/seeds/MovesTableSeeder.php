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
                ['5弱P', 30, 70, 0],
                ['5中P', 60, 100, 0],
                ['波動拳 弱', 60, 100, 0],
            ],
            // 春麗
            2 => [
                ['5弱P', 30, 70, 0],
                ['5中P', 60, 100, 0],
                ['気功拳 弱', 70, 110, 10],
            ],
            // ソル
            101 => [
                ['5P', 10, 0, 0],
                ['5K', 28, 0, 0],
                ['ガンフレイム', 50, 0, 0],
            ],
            // カイ
            102 => [
                ['5P', 10, 0, 0],
                ['5K', 28, 0, 0],
                ['スタンエッジ', 60, 10, 10],
            ]
        ];
        foreach ($list as $characterId => $moves) {
            foreach ($moves as $move) {
                $model = new Move();
                $model->character_id = $characterId;
                $model->name = $move[0];
                $model->damage = $move[1];
                $model->stun = $move[2];
                $model->meter = $move[3];
                $model->save();
            }
        }
    }
}
