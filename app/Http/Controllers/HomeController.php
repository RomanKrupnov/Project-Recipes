<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index')->with('slider',$this->getSlider());
    }
    public function getSlider()
    {
        return Recipe::query()->where([['is_main', '=', '1'],['is_active','=','1']])->get();
    }
}
