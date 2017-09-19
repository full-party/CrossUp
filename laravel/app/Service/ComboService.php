<?php

namespace App\Service;

use App\Model\Combo;
use App\Model\Recipe;
use Session;

/**
 * Class ComboService
 * @package App\Service
 */
class ComboService
{

    /**
     * コンボ作成関数
     *
     * @param array $param コンボ登録パラメーター
     * @return int 作成したコンボID
     */
    public function store(array $param): int
    {
        $comboParam = $param['data'];
        $combo = new Combo();
        $combo->character_id = $comboParam['selectCharacterId'];
        $combo->damage = $comboParam['damage'];
        $combo->stun = $comboParam['stun'];
        $combo->memo = $comboParam['memo'];
        $UserInfo = Session::get('UserInfo');
        $combo->user_id = $UserInfo[0]['id'];
        $combo->save();

        $comboId = $combo->id;
        foreach ($comboParam['combo'] as $key => $value) {
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
        if (count($params) > 0) {
            $query = Combo::where($params)->with('character');
        } else {
            $query = Combo::with('character');
        }
        $resultList = $query->with('recipes.move')->get()->toArray();

        foreach ($resultList as &$result) {
            $result['meter'] = $this->sumMeter($result['recipes']);
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