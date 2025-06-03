<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $cards = Card::with('images')->get();

        return view('home.index',compact('cards'));
    }
}
