<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ComboController extends Controller
{
    public function index()
    {
        return view('combo.index');
    }

    public function show($comboId)
    {
        return view('combo.show');
    }

    public function create()
    {
        return view('combo.create');
    }
}