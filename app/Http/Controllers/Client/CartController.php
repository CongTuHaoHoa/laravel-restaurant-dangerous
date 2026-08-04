<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $total = 0;
        $foodsInCart = [];
        $foodsInSession = $request->session()->get("foods");
        if ($foodsInSession) {
        $foodsInCart = Food::findMany(array_keys($foodsInSession));
        $total = Food::sumPricesByQuantities($foodsInCart, $foodsInSession);
        }
        $viewData = [];
        $viewData["title"] = "Cart - Online Store";
        $viewData["subtitle"] = "Shopping Cart";
        $viewData["total"] = $total;
        $viewData["foods"] = $foodsInCart;
        return view('cart.index')->with("viewData", $viewData);
    }
    public function add(Request $request, $id)
    {
        $foods = $request->session()->get("foods");
        $foods[$id] = $request->input('quantity');
        $request->session()->put('foods', $foods);
        return redirect()->route('cart.index');
    }
    public function delete(Request $request)
    {
        $request->session()->forget('foods');
        return back();
    }
}