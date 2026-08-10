<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\Food;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index(Request $request): Factory|View
    {
        $viewData = [];
        $viewData["title"] = "Home";
        $viewData["categories"] = Category::all();
        $viewData["foods"] = Food::all(); 
        
        

        return view('client.home')->with('viewData', $viewData);
    }

    public function show($id)
    {
        $viewData = [];

        $viewData["food"] = Food::with('comments.user')->findOrFail($id);


        
        
        return view('client.show')->with("viewData", $viewData);
    }
}
