<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    public function index(): Factory|View
    {
        $viewData = [];
        $viewData["title"] = "Trang quản trị | Trang chủ";
        $viewData["subtitle"] = "Trang chủ";

        $viewData["activate"] = "home";
        return view('admin.dashboard.index') -> with("viewData", $viewData);
    }

//    public function food(): Factory|View
//    {
//        $viewData = [];
//        $viewData["title"] = "Trang quản trị | Món ăn";
//        $viewData["subtitle"] = "Món ăn";
//
//        $viewData["activate"] = "food";
//        return view('admin.food') -> with("viewData", $viewData);
//    }

    public function order(): Factory|View
    {
        $viewData = [];
        $viewData["title"] = "Trang quản trị | Đơn hàng";
        $viewData["subtitle"] = "Đơn hàng";

        $viewData["activate"] = "order";
        return view('admin.order.index') -> with("viewData", $viewData);
    }

    public function category(): Factory|View
    {
        $viewData = [];
        $viewData["title"] = "Trang quản trị | Danh mục";
        $viewData["subtitle"] = "Danh mục";

        $viewData["activate"] = "category";
        return view('admin.category.index') -> with("viewData", $viewData);
    }

    public function employee(): Factory|View
    {
        $viewData = [];
        $viewData["title"] = "Trang quản trị | Nhân viên";
        $viewData["subtitle"] = "Nhân viên";

        $viewData["activate"] = "employee";
        return view('admin.employee.index') -> with("viewData", $viewData);
    }

    public function profile(): Factory|View
    {
        $viewData = [];
        $viewData["title"] = "Trang quản trị | Thông tin cá nhân";
        $viewData["subtitle"] = "Thông tin cá nhân";

        $viewData["activate"] = "profile";
        return view('admin.profile.index') -> with("viewData", $viewData);
    }
}
