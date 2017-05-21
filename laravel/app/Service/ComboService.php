<?php

namespace App\Service;

use App\Model\Combo;

class ComboService
{
    public function find(int $id)
    {
        return Combo::find($id);
    }

    public function list(array $params)
    {
        if (count($params) > 0) {
            $result = Combo::where($params)->get();
        } else {
            $result = Combo::all();
        }
        return $result;
    }
}