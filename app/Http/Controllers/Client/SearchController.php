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
    public function index(Request $request): Factory|View
    {
        $viewData = [];

        $viewData["title"] = "Home";
        $viewData["categories"] = Category::all();

        $query = Food::query();

        if ($request->filled('search')) {
            $query->where('FOD_NAME', 'like', '%' . $request->search . '%');
        }

        $viewData["foods"] = $query->get();

        return view('client.index')->with('viewData', $viewData);
    }
}