<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\Food;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(): Factory|View
    {
        $viewData = [];
        $viewData["title"] = "Home";
        $viewData["categories"] = Category::all();
        $viewData["foods"] = Food::all();
       

        return view('client.search.index')->with('viewData', $viewData);
    }

    public function Search(Request $request): Factory|View
    {
        $query = Food::query();
        if ($request->filled('search')) 
        {
            $query->where('FOD_NAME', 'like', '%' . $request->search . '%');
        }
        $viewData["foods"] = $query->get();
        return view('client.search.index')->with('viewData', $viewData);
    }
}