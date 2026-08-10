<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(): Factory|View
    {
        $viewData = [];
        $viewData["title"] = "Trang quản trị | Trang chủ";
        $viewData["subtitle"] = "Trang chủ";
        
        // Tổng doanh thu từ các đơn hàng có status = 3 (đã hoàn thành)
        $viewData["totalRevenue"] = Order::where('status', 3)->sum('total');
        
        // Tổng số khách hàng (role = 'client')
        $viewData["totalCustomers"] = User::where('role', 'client')->count();
        
        // Lấy 5 đơn hàng đang chờ xử lý mới nhất
        $viewData["orders"] = Order::where('status', 1)->orderBy('created_at', 'asc')->limit(5)->get();
        
        // Doanh thu 6 tháng gần nhất
        $revenueData = [];
        $monthLabels = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $month = $date->month;
            $year = $date->year;
            
            // Tính tổng doanh thu của tháng đó (chỉ tính đơn hàng đã hoàn thành - status = 3)
            $revenue = Order::where('status', 3)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->sum('total');
            
            $revenueData[] = $revenue;
            $monthLabels[] = 'Tháng ' . $month;
        }
        
        $viewData["revenueData"] = $revenueData;
        $viewData["monthLabels"] = $monthLabels;
        
        // Tính phần trăm tăng trưởng so với tháng trước
        $currentMonthRevenue = Order::where('status', 3)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total');
            
        $lastMonthRevenue = Order::where('status', 3)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->sum('total');
        
        $viewData["revenueGrowth"] = $lastMonthRevenue > 0 
            ? round((($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1)
            : 0;
        
        // Tính phần trăm tăng trưởng khách hàng so với tháng trước
        $currentMonthCustomers = User::where('role', 'client')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
            
        $lastMonthCustomers = User::where('role', 'client')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
        
        $viewData["customerGrowth"] = $lastMonthCustomers > 0
            ? round((($currentMonthCustomers - $lastMonthCustomers) / $lastMonthCustomers) * 100, 1)
            : 0;

        $viewData["activate"] = "home";
        return view('admin.dashboard.index')->with("viewData", $viewData);
    }
}
