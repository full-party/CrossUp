<?php

use App\Model\ComboStatus;
use Illuminate\Database\Seeder;

class ComboStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('combo_statuses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // コンボID => [ステータス]
        $data = [
            1 => [1, 2]
        ];

        foreach ($data as $comboId => $statuses) {
            foreach ($statuses as $status) {
                $model = new ComboStatus();
                $model->combo_id = $comboId;
                $model->status_id = $status;
                $model->save();
            }
        }
    }
}
