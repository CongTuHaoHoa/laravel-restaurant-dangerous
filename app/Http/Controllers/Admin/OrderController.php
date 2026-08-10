<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function edit($id): RedirectResponse
    {
        $order = Order::findOrFail($id);

        $order->status = 2;
        $order->save();

        return redirect()->route('order.index');
    }
    public function index(): Factory|View
    {
        $viewData = [];
        $viewData["title"] = "Trang quản trị | Đơn hàng";
        $viewData["subtitle"] = "Đơn hàng";
        $viewData["orders"] = Order::paginate(7);

        $viewData["activate"] = "order";
        return view('admin.order.index') -> with("viewData", $viewData);
    }
    public function info($id)
    {
        $order = Order::findOrFail($id);

        $viewData = [];
        $viewData["title"] = "Đơn hàng | Chi tiết";
        $viewData["subtitle"] = "Chi tiết";
        $viewData["activate"] = "order";
        $viewData["order"] = $order;

        return view('admin.order.info') -> with("viewData", $viewData);
    }
}
