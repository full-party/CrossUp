<?php

namespace App\Service;

use App\Model\Combo;
use App\Model\Recipe;
use Config;

/**
 * Class ComboService
 * @package App\Service
 */
class ComboService
{

    /**
     * コンボ作成関数
     *
     * @param array $comboData コンボ登録データ
     * @return int 作成したコンボID
     */
    public function store(array $comboData): int
    {
        $combo = new Combo();
        $combo->character_id = $comboData['selectCharacterId'];
        $combo->damage = $comboData['damage'];
        $combo->stun = $comboData['stun'];
        $combo->memo = $comboData['memo'];
        $combo->user_id = $comboData['user_id'];
        $combo->save();

        $comboId = $combo->id;
        foreach ($comboData['combo'] as $key => $value) {
            $model = new Recipe();
            $model->combo_id = $comboId;
            $model->move_id = $value['id'];
            $model->order = $key;
            $model->save();
        }
        return $combo->id;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        $result = Combo::with('character', 'recipes.move')->find($id)->toArray();
        $result['meter'] = $this->sumMeter($result['recipes']);

        return response($result);
    }

    /**
     * @param array $params
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function list(array $params)
    {
        $query = Combo::with('character');

        // キャラクターの絞り込み
        if (isset($params['character_id']) && !is_null($params['character_id']) && is_numeric($params['character_id'])) {
            $query = $query->character($params['character_id']);
        }

        // ソート
        $sort = Config::get('sort');
        if (isset($params['selectSortId']) && isset($sort[$params['selectSortId']])) {
            // パラメーターにソートが指定されている場合、ソートを設定
            $sortInfo = $sort[$params['selectSortId']];
            $query = $query->orderBy($sortInfo['column'], $sortInfo['order']);
        }

        // コンボ取得
        $resultList = $query->with('recipes.move')->get()->toArray();

        // 各コンボの技ゲージの合計値を計算し追加
        foreach ($resultList as &$result) {
            $result['meter'] = $this->sumMeter($result['recipes']);
        }

        // 始動技の絞り込み
        if (isset($params['move_id']) && !is_null($params['move_id']) && is_numeric($params['move_id'])) {
            $resultList = array_filter($resultList, function($result) use($params) {
                return strcmp($result['recipes'][0]['move_id'], $params['move_id']) === 0;
            });
        }

        return response($resultList);
    }

    /**
     * レシピコレクションから技ゲージの合計値を返す
     *
     * @param $recipes
     * @return int
     */
    private function sumMeter(array $recipes): int
    {
        $meter = 0;
        foreach ($recipes as $recipe) {
            $meter += $recipe['move']['meter'];
        }
        return $meter;
    }
}