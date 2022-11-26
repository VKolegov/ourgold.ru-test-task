<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('index');
    }
}
