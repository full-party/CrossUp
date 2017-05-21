<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GameService;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        return GameService::find($request->get('id'));
    }
}