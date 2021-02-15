<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;
use App\Room;
use App\Categorie;
use App\Images;

class WelcomesController extends Controller
{
    public function index(){
        $highlights = 'true';
        $condition = true;
        $foods = Food::when($condition, function ($query) use ($highlights) {
            return $query->where('highlights', $highlights)->orderBy('created_at','desc');
        })
        ->paginate(9);

        $categories =  Categorie::orderBy('created_at','desc')->paginate();
        $rooms =  Room::all();
        $images = Images::all();

        $categories_all =  Categorie::orderBy('created_at','desc')->paginate();
        $foods_hightlight_all = Food::when($condition, function ($query) use ($highlights) {
            return $query->where('highlights', $highlights)->orderBy('created_at','desc');
        })
        ->paginate(9);

        return view('welcome',['foods'=>$foods , 'categories' => $categories, 'rooms' => $rooms, 'images' => $images, 'categories_all'=>$categories_all, 'foods_hightlight_all'=>$foods_hightlight_all]);
    }
}
