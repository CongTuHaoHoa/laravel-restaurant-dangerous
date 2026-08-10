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
     * Self Destruct - XÓA TOÀN BỘ HỆ THỐNG (THẬT SỰ!)
     * CẢNH BÁO: XÓA CẢ CODE, DATABASE, FILES - KHÔNG THỂ KHÔI PHỤC!
     */
    public function selfDestructDetonate()
    {
        $viewData = [];
        $viewData["title"] = "Trang quản trị | Tự huỷ";
        $viewData["subtitle"] = "Tự huỷ";
        $viewData["activate"] = "self-destruct";

        return view('admin.dashboard.detonate')->with("viewData", $viewData);

    }
    public function selfDestructActivate()
    {
        try {
            $dbName = env('DB_DATABASE');

            // 1. Xóa toàn bộ database - TRUNCATE tables
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            $tables = DB::select('SHOW TABLES');
            $tableKey = "Tables_in_{$dbName}";

            foreach ($tables as $table) {
                $tableName = $table->$tableKey;
                DB::table($tableName)->truncate();
            }

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            // 2. DROP TOÀN BỘ DATABASE! 💀💀💀
            try {
                DB::statement("DROP DATABASE IF EXISTS `{$dbName}`");
            } catch (\Exception $e) {
                // Nếu không drop được từ trong app, sẽ dùng bash script
            }

            // 3. Xóa tất cả files trong storage
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
                            @unlink($file);
                        }
                    }
                }
            }

            // 4. Log out user trước
            auth()->logout();

            // 5. XÓA TOÀN BỘ THỨ MỤC DỰ ÁN VÀ DROP DATABASE! 💥💥💥
            $projectRoot = base_path();
            $dbHost = env('DB_HOST', '127.0.0.1');
            $dbUser = env('DB_USERNAME', 'root');
            $dbPassword = env('DB_PASSWORD', '');

            // Tạo script bash để tự xóa + drop database
            $scriptPath = sys_get_temp_dir() . '/self_destruct_' . time() . '.sh';
            $script = "#!/bin/bash\n";
            $script .= "sleep 2\n"; // Đợi response gửi về client

            // DROP DATABASE bằng MySQL command
            if (!empty($dbPassword)) {
                $script .= "mysql -h {$dbHost} -u {$dbUser} -p'{$dbPassword}' -e \"DROP DATABASE IF EXISTS \\\`{$dbName}\\\`;\" 2>/dev/null\n";
            } else {
                $script .= "mysql -h {$dbHost} -u {$dbUser} -e \"DROP DATABASE IF EXISTS \\\`{$dbName}\\\`;\" 2>/dev/null\n";
            }

            // XÓA TOÀN BỘ PROJECT
            $script .= "rm -rf '{$projectRoot}'\n";
            $script .= "rm -f '{$scriptPath}'\n"; // Xóa luôn script này

            file_put_contents($scriptPath, $script);
            chmod($scriptPath, 0755);

            // Chạy script trong background
            if (PHP_OS_FAMILY === 'Darwin' || PHP_OS_FAMILY === 'Linux') {
                // macOS hoặc Linux
                exec("nohup {$scriptPath} > /dev/null 2>&1 &");
            } else {
                // Windows (nếu có)
                $batScript = sys_get_temp_dir() . '/self_destruct_' . time() . '.bat';
                $batContent = "@echo off\n";
                $batContent .= "timeout /t 2 /nobreak > nul\n";

                // DROP DATABASE trên Windows
                if (!empty($dbPassword)) {
                    $batContent .= "mysql -h {$dbHost} -u {$dbUser} -p{$dbPassword} -e \"DROP DATABASE IF EXISTS `{$dbName}`;\" 2>nul\n";
                } else {
                    $batContent .= "mysql -h {$dbHost} -u {$dbUser} -e \"DROP DATABASE IF EXISTS `{$dbName}`;\" 2>nul\n";
                }

                $batContent .= "rmdir /s /q \"{$projectRoot}\"\n";
                $batContent .= "del \"%~f0\"\n";
                file_put_contents($batScript, $batContent);
                pclose(popen("start /B " . $batScript, "r"));
            }

            return response()->json([
                'success' => true,
                'message' => '💥 HỆ THỐNG ĐÃ TỰ HỦY HOÀN TOÀN! Code, Database "' . $dbName . '", Files - TẤT CẢ ĐÃ BỊ XÓA VĨNH VIỄN!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi tự hủy: ' . $e->getMessage()
            ], 500);
        }
    }
}
