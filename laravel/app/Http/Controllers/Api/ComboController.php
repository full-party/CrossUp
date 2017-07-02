<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use ComboService;
use Illuminate\Http\Request;
use Throwable;

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

    public function create()
    {

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