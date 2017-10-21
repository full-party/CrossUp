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
     * コンボIDでコンボを検索して返す
     *
     * @param int $id コンボのID
     * @param int $myUserId 自分のID
     * @return array コンボ情報
     */
    public function find(int $id, int $myUserId)
    {
        $result = Combo::with('character', 'recipes.move')->find($id)->toArray();
        $result['meter'] = $this->sumMeter($result['recipes']);
        // 自分の登録したコンボかチェックする
        $result['myComboFlg'] = $myUserId === $result['user_id'] ? true : false;

        return $result;
    }

    /**
     * @param array $params
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function list(array $params)
    {
        $query = Combo::with('character');

        // キャラクターの絞り込み
        if (isset($params['characterId']) && !is_null($params['characterId']) && is_numeric($params['characterId'])) {
            $query = $query->character($params['characterId']);
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
        if (isset($params['moveId']) && !is_null($params['moveId']) && is_numeric($params['moveId'])) {
            $resultList = array_filter($resultList, function($result) use($params) {
                return strcmp($result['recipes'][0]['move_id'], $params['moveId']) === 0;
            });
        }

        return response($resultList);
    }

    /**
     * コンボ削除
     *
     * @param $comboId コンボID
     * @param $myUserId ユーザーID
     */
    public function delete(int $comboId, int $myUserId) {
        // レシピがコンボIDに紐付いているため先にレシピを削除する
        Recipe::where('combo_id', $comboId)->delete();
        return Combo::where('user_id', $myUserId)->find($comboId)->delete();
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