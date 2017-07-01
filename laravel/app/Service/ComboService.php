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
        return Combo::find($id);
    }

    /**
     * @param array $params
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function list(array $params)
    {
        if (count($params) > 0) {
            $result = Combo::where($params)->with('character');
        } else {
            $result = Combo::with('character');
        }

        return response($result->with(['recipes' => function ($query) {
            $query->where('order', 1);
        }])->get());
    }
}