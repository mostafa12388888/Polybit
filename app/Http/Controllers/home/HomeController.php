<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Card;

class HomeController extends Controller
{
    public function index()
    {
        $cards = Card::with('media_file')->get();
        return view('home.index', compact('cards'));
    }
}
