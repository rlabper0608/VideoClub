<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MainController extends Controller {
   function main(): View {
        // $peinados = Peinado::all();
        // return view('main.main', ['peinados' => $peinados]);
        return view('main.main');
    }
}

