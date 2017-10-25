<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use ComboService;
use Illuminate\Http\Request;
use Throwable;
use Log;
use DB;
use Session;
use App\Http\Requests\ComboStore;
use App\Http\Requests\ComboUpdate;

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
            // コンボ登録用データを作る
            $comboData = $request->all();
            $UserInfo = Session::get('UserInfo');
            $comboData['user_id'] = $UserInfo[0]['id'];
            DB::transaction(function () use($comboData) {
                return ComboService::store($comboData);
            });
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
            $UserInfo = Session::get('UserInfo');
            return response(ComboService::find($comboId, $UserInfo[0]['id']));
        } catch (Throwable $t) {
            Log::error($t);
            return response(['message' => 'internal server error'], 500);
        }
    }

    /**
     * コンボ更新API
     *
     * @param ComboUpdate $request コンボ登録用リクエストパラメーター
     */
    public function update(ComboUpdate $request)
    {
        try {
            $newCombo = $request->all();
            $UserInfo = Session::get('UserInfo');
            $oldCombo = ComboService::find($newCombo['id'], $UserInfo[0]['id']);
            if ($oldCombo['myComboFlg']) {
                DB::transaction(function () use($newCombo) {
                    return ComboService::update($newCombo);
                });
            } else {
                return response(['message' => 'invalid combo id'], 400);
            }
        } catch (Throwable $t) {
            Log::error($t);
            return response(['message' => 'internal server error'], 500);
        }
    }

    /**
     * コンボ削除API
     *
     * @param $comboId コンボID
     * @return 失敗時は500エラー,他人のコンボIDの場合は400エラー
     */
    public function destroy(int $comboId)
    {
        try {
            $UserInfo = Session::get('UserInfo');
            $combo = ComboService::find($comboId, $UserInfo[0]['id']);
            if ($combo['myComboFlg']) {
                // 自分のコンボの場合削除する
                DB::transaction(function () use($comboId, $UserInfo) {
                    return ComboService::delete($comboId, $UserInfo[0]['id']);
                });
            } else {
                return response(['message' => 'invalid combo id'], 400);
            }
        } catch (Throwable $t) {
            Log::error($t);
            return response(['message' => 'internal server error'], 500);
        }
    }
}