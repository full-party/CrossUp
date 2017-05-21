<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use ComboService;
use Illuminate\Http\Request;

class ComboController extends Controller
{
    public function index(Request $request)
    {
        return ComboService::list($request->all());
    }

    public function create()
    {

    }

    public function show(int $comboId)
    {
        return ComboService::find($comboId);
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}