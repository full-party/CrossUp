<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MoveIndex;
use MoveService;
use Throwable;

/**
 * Class MoveController
 * @package App\Http\Controllers\Api
 */
class MoveController extends Controller
{
    /**
     * @param MoveIndex $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index(MoveIndex $request)
    {
        try{
            return MoveService::list($request->characterId);
        } catch (Throwable $t) {
            Log::error($t);
            return response(['message' => 'internal server error'], 500);
        }
    }
}
