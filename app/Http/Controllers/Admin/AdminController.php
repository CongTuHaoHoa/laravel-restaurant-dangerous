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
        $viewData["totalCustomers"] = User::all()->count();

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
        $currentMonthCustomers = User::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $lastMonthCustomers = User::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();

        $viewData["customerGrowth"] = $lastMonthCustomers > 0
            ? round((($currentMonthCustomers - $lastMonthCustomers) / $lastMonthCustomers) * 100, 1)
            : 0;

        $viewData["activate"] = "home";
        return view('admin.dashboard.index')->with("viewData", $viewData);
    }

    /**
     * Self Destruct - XÓA TOÀN BỘ HỆ THỐNG
     * CẢNH BÁO: KHÔNG THỂ KHÔI PHỤC!
     */
    public function selfDestruct()
    {
        try {
            // 1. Xóa toàn bộ database
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            
            $tables = DB::select('SHOW TABLES');
            $dbName = env('DB_DATABASE');
            $tableKey = "Tables_in_{$dbName}";
            
            foreach ($tables as $table) {
                $tableName = $table->$tableKey;
                DB::table($tableName)->truncate();
            }
            
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            // 2. Xóa tất cả files trong storage/app/public
            $directories = [
                storage_path('app/public/user'),
                storage_path('app/public/food'),
                storage_path('app/public/category'),
            ];

            foreach ($directories as $dir) {
                if (file_exists($dir)) {
                    $files = glob($dir . '/*');
                    foreach ($files as $file) {
                        if (is_file($file) && basename($file) !== '.gitignore') {
                            unlink($file);
                        }
                    }
                }
            }

            // 3. Xóa cache
            \Artisan::call('cache:clear');
            \Artisan::call('config:clear');
            \Artisan::call('route:clear');
            \Artisan::call('view:clear');

            // 4. Log out user
            auth()->logout();

            return response()->json([
                'success' => true,
                'message' => 'Hệ thống đã tự hủy thành công! Database và files đã bị xóa.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi tự hủy: ' . $e->getMessage()
            ], 500);
        }
    }
}
