<?php

namespace App\Http\Controllers\Hotsite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('hotsite.index');
    }

    public function cadastro()
    {
        return view('hotsite.cadastro');
    }

}
