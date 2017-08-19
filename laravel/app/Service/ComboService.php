<?php

namespace App\Service;

use App\Model\Combo;

/**
 * Class ComboService
 * @package App\Service
 */
class ComboService
{
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
    public function sumMeter(array $recipes): int
    {
        $meter = 0;
        foreach ($recipes as $recipe) {
            $meter += $recipe['move']['meter'];
        }
        return $meter;
    }
}