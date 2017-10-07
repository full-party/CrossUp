<?php

use App\Model\Recipe;
use Illuminate\Database\Seeder;

class RecipesTableSeeder extends Seeder
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
                1 => [
                    [1002, 1], [1002, 2], [1003, 3]
                ]
            ],
        ];
        foreach ($list as $characterId => $combos) {
            foreach ($combos as $comboId => $combo) {
                foreach ($combo as $recipe) {
                    $model = new Recipe();
                    $model->combo_id = $comboId;
                    $model->move_id = $recipe[0];
                    $model->order = $recipe[1];
                    $model->save();
                }
            }
        }
    }
}
