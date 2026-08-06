<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\Food;

class FoodController extends Controller
{
    public function index(): Factory|View
    {
        $viewData = [];
        $viewData["title"] = "Home";
        $viewData["foods"] = Food::all();   
        return view('client.home') -> with("viewData", $viewData);
    }

    public function show($id)
    {
        $viewData = [];

        $viewData["food"] = Food::with('comments.user')->findOrFail($id);

        return view('client.show')->with("viewData", $viewData);
    }
}
