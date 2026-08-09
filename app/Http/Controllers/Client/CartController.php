<?php

namespace App\Http\Controllers\Client;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\FoodOrders;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

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

    public function purchase(Request $request) 
    {
        $foodsInSession = $request->session()->get("foods");
        if ($foodsInSession) {
        $userId = Auth::user()->id;
        $order = new Order();
        $order->user_id = $userId;
        $order->total = 0;
        $order->save();
        $total = 0;
        $foodsInCart = Food::findMany(array_keys($foodsInSession));
        foreach ($foodsInCart as $food) {
        $quantity = $foodsInSession[$food->FOD_ID];
        $foodOrder = new FoodOrders();
        $foodOrder->quantity = $quantity;
        $foodOrder->price = $food->FOD_PRICE;
        $foodOrder->food_id = $food->FOD_ID;
        $foodOrder->order_id = $order->id;
        $foodOrder->save();
        $total = $total + ($food->FOD_PRICE * $quantity);
        }
        $order->total = $total;
        $order->address = Auth::user()->address;
        $order->address = $request->address;
        $order->status = '1';
        $order->save();
        $newBalance = Auth::user()->balance - $total;
        Auth::user()->balance = $newBalance;
        Auth::user()->save();
        $request->session()->forget('foods');
        $viewData = [];
        $viewData["title"] = "Purchase - Online Store";
        $viewData["subtitle"] = "Purchase Status";
        $viewData["order"] = $order;
        return view('cart.purchase')->with("viewData", $viewData);
        } else {
        return redirect()->route('cart.index');
        }
    }
}