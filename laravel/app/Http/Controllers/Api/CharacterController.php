<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use CharacterService;
use Log;
use Throwable;

class CharacterController extends Controller
{
    /**
     * キャラクター一覧
     *
     * @return array
     */
    public function index()
    {
        try {
            $result = CharacterService::list();
        } catch (Throwable $t) {
            Log::error($t);
            return response(['message' => 'internal server error'], 500);
        }
        return $result;
    }

}
