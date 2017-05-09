<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use ComboService;

class ComboController extends Controller
{
    public function index()
    {
        ComboService::find();
    }

    public function create()
    {

    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}