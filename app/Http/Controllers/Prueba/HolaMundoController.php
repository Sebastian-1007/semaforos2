<?php

namespace App\Http\Controllers\Prueba;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HolaMundoController extends Controller
{
    public function index(){
        return view('prueba.hola_mundo');
    }
}
