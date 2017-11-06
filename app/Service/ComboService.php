<?php

namespace App\Service;

use App\Model\Combo;
use App\Model\ComboStatus;
use App\Model\Recipe;
use Config;

/**
 * Class ComboService
 * @package App\Service
 */
class ComboService
{
    /**
     * コンボ登録・更新
     *
     * @param array $comboData コンボ登録データ
     * @param int|null $comboId 更新の場合はidを渡す
     * @return int 作成したコンボID
     */
    public function storeOrUpdate(array $comboData, int $comboId = null): int
    {
        // コンボIDが設定されている場合は更新、レシピとステータスはDELETE・INSERTする。
        if (is_null($comboId)) {
            $comboId = Combo::create($comboData)->id;
        } else {
            Combo::find($comboId)->fill($comboData)->save();
            Recipe::where('combo_id', $comboId)->delete();
            ComboStatus::where('combo_id', $comboId)->delete();
        }

        foreach ($comboData['combo'] as $key => $value) {
            Recipe::create(['combo_id' => $comboId, 'move_id' => $value['id'], 'order' => $key]);
        }
        foreach ($comboData['status'] ?? [] as $status_id) {
            ComboStatus::create(['combo_id' => $comboId, 'status_id' => $status_id]);
        }

        return $comboId;
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
        $combo = Combo::with('character', 'recipes.move', 'comboStatuses.status')->find($id);
        if (is_null($combo)) {
            return [];
        }
        $result = $combo->toArray();
        $result['meter'] = $this->sumMeter($result['recipes']);

        // TODO: vuexを入れてフロントでユーザーIDを保持するようになったらいらないかも？
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

        // コンボステータス絞り込み
        if (isset($params['status'])) {
            $query = $query->comboStatus($params['status']);
        }

        // ソート
        $sort = Config::get('sort');
        if (isset($params['selectSortId']) && isset($sort[$params['selectSortId']])) {
            // パラメーターにソートが指定されている場合、ソートを設定
            $sortInfo = $sort[$params['selectSortId']];
            $query = $query->orderBy($sortInfo['column'], $sortInfo['order']);
        }

        // コンボ取得
        $resultList = $query->with(['recipes.move', 'comboStatuses.status'])->get()->toArray();

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
     * @param int $comboId コンボID
     * @param int $myUserId ユーザーID
     * @return bool|null
     */
    public function delete(int $comboId, int $myUserId) {
        // レシピとコンボステータスがコンボIDに紐付いているため先にレシピを削除する
        Recipe::where('combo_id', $comboId)->delete();
        ComboStatus::where('combo_id', $comboId)->delete();
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