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

        // キャラのCSVファイルを読み込む
        foreach(glob('database/seeds/data/moves/{*.csv}',GLOB_BRACE) as $file){
            $data = new SplFileObject($file);
            $data->setFlags(SplFileObject::READ_CSV);

            // キャラクターIDはファイル名から取得する
            $fileName = $data->getBasename();
            $characterId = explode('_', $fileName)[0];

            foreach ($data as $index => $line) {
                // 1行目はヘッダー行なのでスキップ
                if ($index > 0) {
                    $model = new Move();
                    $model->character_id = $characterId;
                    $model->id = $line[0];
                    $model->name = $line[1];
                    $model->damage = $line[2];
                    $model->stun = $line[3];
                    $model->meter = $line[4];
                    $model->save();
                }
            }
        }
    }
}
