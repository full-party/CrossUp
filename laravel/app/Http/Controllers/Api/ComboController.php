<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use ComboService;
use Illuminate\Http\Request;
use Throwable;
use Log;
use App\Http\Requests\ComboStore;

class ComboController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        try {
            return ComboService::list($request->all());
        } catch (Throwable $t) {
            Log::error($t);
            return response(['message' => 'internal server error'], 500);
        }
    }

    /**
     * コンボ登録API
     * @param ComboStore $request コンボ登録用リクエストパラメーター
     * @return int 成功時コンボIDを返す。失敗時は500エラー
     */
    public function store(ComboStore $request)
    {
        try {
            return ComboService::store($request->all());
        } catch (Throwable $t) {
            Log::error($t);
            return response(['message' => 'internal server error'], 500);
        }
    }

    /**
     * @param int $comboId
     * @return mixed
     */
    public function show(int $comboId)
    {
        try {
            return ComboService::find($comboId);
        } catch (Throwable $t) {
            Log::error($t);
            return response(['message' => 'internal server error'], 500);
        }
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}