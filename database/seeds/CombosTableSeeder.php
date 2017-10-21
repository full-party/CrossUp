<?php

use App\Model\Combo;
use Illuminate\Database\Seeder;

class CombosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('combos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $list = [
            // リュウ
            1 => [
                [130, 150, '基本コンボ', 1],
            ],
        ];
        foreach ($list as $characterId => $combos) {
            foreach ($combos as $combo) {
                $model = new Combo();
                $model->character_id = $characterId;
                $model->damage = $combo[0];
                $model->stun = $combo[1];
                $model->memo = $combo[2];
                $model->user_id = $combo[3];
                $model->save();
            }
        }
    }
}
