<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\Food;
use App\Models\Order;
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

        $query = DB::table('Food as f')
            ->select('f.*');

        if ($request->filled('category')) {
            $query->whereExists(function ($q) use ($request) {
                $q->select(DB::raw(1))
                ->from('FoodContainsCategory as fcc')
                ->whereColumn('fcc.FOD_ID', 'f.FOD_ID')
                ->where('fcc.CTG_ID', $request->category);
            });
        }

        $viewData["foods"] = $query->get();

        return view('client.home')->with('viewData', $viewData);
    }

    public function show($id)
    {
        $viewData = [];

        $viewData["food"] = Food::with('comments.user')->findOrFail($id);

        return view('client.show')->with("viewData", $viewData);
    }

}
