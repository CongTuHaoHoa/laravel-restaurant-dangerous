<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\Food;
use App\Models\Category;
use App\Models\FoodContainsCategory;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    public function index(): Factory|View
    {
        $viewData = [];
        $viewData["title"] = "Home";
        $viewData["categories"] = Category::all();
        $viewData["foods"] = Food::all(); 
        

        $viewData["foodsCategory"] = DB::table('Food as f')
            ->join('FoodContainsCategory as fcc', 'f.FOD_ID', '=', 'fcc.FOD_ID')
            ->join('Category as c', 'fcc.CTG_ID', '=', 'c.CTG_ID')
            ->select(
                'f.*',
                'c.CTG_ID',
                'c.CTG_NAME'
            )
            ->get();


        return view('client.home')->with('viewData', $viewData);
    }

    public function show($id)
    {
        $viewData = [];

        $viewData["food"] = Food::with('comments.user')->findOrFail($id);


        
        
        return view('client.show')->with("viewData", $viewData);
    }
}
