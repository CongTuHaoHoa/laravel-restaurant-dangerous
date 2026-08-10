<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    public function index(): Factory|View
    {
        $viewData = [];
        $viewData["title"] = "Trang quản trị | Trang chủ";
        $viewData["subtitle"] = "Trang chủ";
        $viewData["orders"] = Order::where('status', 1)->orderBy('created_at', 'asc')->limit(5)->get();

        $viewData["activate"] = "home";
        return view('admin.dashboard.index') -> with("viewData", $viewData);
    }
}
