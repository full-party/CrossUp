<?php

namespace App\Http\Controllers\Api\Combos;

use App\Http\Requests\Combos\StatusIndex;
use App\Http\Controllers\Controller;
use CombosStatusService;
use Log;
use Throwable;

/**
 * Class StatusController
 * @package App\Http\Controllers\Api\Combos
 */
class StatusController extends Controller
{
    /**
     * コンボステータス一覧取得
     * @param StatusIndex $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index(StatusIndex $request)
    {
        try {
            return CombosStatusService::list($request->get('gameId'));
        } catch (Throwable $t) {
            Log::error($t);
            return response(['message' => 'internal server error'], 500);
        }
    }
}
