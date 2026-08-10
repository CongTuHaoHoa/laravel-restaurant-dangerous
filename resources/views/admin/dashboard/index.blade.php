@extends('layouts.admin')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    <div class="w-full px-6 py-6 mx-auto">
        <!-- Thống kê tổng quan - Row 1 -->
        <div class="flex flex-wrap -mx-3">
            <!-- Card Tổng Doanh Thu -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/2">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border hover:shadow-2xl transition-all duration-300">
                    <div class="flex-auto p-6">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-2 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-slate-500">
                                        Tổng Doanh Thu
                                    </p>
                                    <h5 class="mb-2 font-bold text-2xl dark:text-white text-slate-800">
                                        {{ number_format($viewData['totalRevenue'], 0, ',', '.') }} ₫
                                    </h5>
                                    <p class="mb-0 dark:text-white dark:opacity-60 text-sm">
                                        <span class="text-sm font-bold leading-normal {{ $viewData['revenueGrowth'] >= 0 ? 'text-emerald-500' : 'text-red-500' }}">
                                            <i class="fa {{ $viewData['revenueGrowth'] >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                                            {{ abs($viewData['revenueGrowth']) }}%
                                        </span>
                                        so với tháng trước
                                    </p>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div class="inline-flex items-center justify-center text-white w-16 h-16 text-center rounded-xl bg-gradient-to-tl from-emerald-500 to-teal-400 shadow-lg">
                                    <i class="fa-solid fa-coins text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Tổng Khách Hàng -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/2">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border hover:shadow-2xl transition-all duration-300">
                    <div class="flex-auto p-6">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-2 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-slate-500">
                                        Tổng Khách Hàng
                                    </p>
                                    <h5 class="mb-2 font-bold text-2xl dark:text-white text-slate-800">
                                        {{ number_format($viewData['totalCustomers'], 0, ',', '.') }}
                                    </h5>
                                    <p class="mb-0 dark:text-white dark:opacity-60 text-sm">
                                        <span class="text-sm font-bold leading-normal {{ $viewData['customerGrowth'] >= 0 ? 'text-emerald-500' : 'text-red-500' }}">
                                            <i class="fa {{ $viewData['customerGrowth'] >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                                            {{ abs($viewData['customerGrowth']) }}%
                                        </span>
                                        so với tháng trước
                                    </p>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div class="inline-flex items-center justify-center text-white w-16 h-16 text-center rounded-xl bg-gradient-to-tl from-blue-500 to-violet-500 shadow-lg">
                                    <i class="fa-solid fa-users text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Biểu đồ và Đơn hàng - Row 2 -->
        <div class="flex flex-wrap mt-6 -mx-3">
            <!-- Biểu đồ Doanh Thu 6 Tháng -->
            <div class="w-full max-w-full px-3 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
                <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                        <div class="flex justify-between items-center">
                            <div>
                                <h6 class="capitalize dark:text-white text-slate-800 font-bold mb-1">Biểu Đồ Doanh Thu</h6>
                                <p class="mb-0 text-sm leading-normal dark:text-white dark:opacity-60 text-slate-500">
                                    <i class="fa fa-chart-line text-emerald-500"></i>
                                    <span class="font-semibold">6 tháng gần nhất</span>
                                </p>
                            </div>
                            <div class="text-right">
                                <span class="text-xs font-semibold inline-block py-1 px-2 rounded-lg text-emerald-600 bg-emerald-200 uppercase">
                                    Đã hoàn thành
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto p-6">
                        <div class="relative" style="height: 300px;">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Đơn Hàng Đang Chờ -->
            <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
                <div class="border-black/12.5 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="p-6 pb-3 rounded-t-2xl border-b border-slate-100">
                        <div class="flex justify-between items-center">
                            <h6 class="mb-0 dark:text-white text-slate-800 font-bold">Đơn Hàng Chờ Xử Lý</h6>
                            <span class="text-xs font-semibold inline-block py-1 px-2 rounded-lg text-orange-600 bg-orange-100">
                                {{ count($viewData['orders']) }} đơn
                            </span>
                        </div>
                    </div>
                    <div class="flex-auto p-4" style="max-height: 350px; overflow-y: auto;">
                        @if(count($viewData['orders']) > 0)
                            <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                                @foreach($viewData['orders'] as $order)
                                    <li class="relative flex justify-between items-center py-3 px-4 mb-2 border-0 rounded-xl bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 dark:hover:bg-slate-700 transition-all duration-200">
                                        <div class="flex items-center">
                                            <div class="relative">
                                                <img src="{{ asset('/storage/user/'.$order->user->avatar) }}" 
                                                     class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-12 w-12 rounded-xl object-cover shadow-md" 
                                                     alt="{{ $order->user->name }}" />
                                                <span class="absolute -bottom-1 -right-1 bg-orange-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                                                    {{ $order->foodOrders->sum('quantity') }}
                                                </span>
                                            </div>
                                            <div class="flex flex-col">
                                                <h6 class="mb-1 text-sm font-semibold leading-normal text-slate-700 dark:text-white">
                                                    {{ $order->user->name }}
                                                </h6>
                                                <span class="text-xs leading-tight text-slate-500 dark:text-white/80">
                                                    <i class="fa-solid fa-utensils mr-1"></i>{{ $order->foodOrders->sum('quantity') }} món ăn
                                                </span>
                                                <span class="text-xs leading-tight text-emerald-600 dark:text-emerald-400 font-semibold mt-1">
                                                    {{ number_format($order->total, 0, ',', '.') }} ₫
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <a href="{{ route('order.info', $order->id) }}" 
                                               class="group ease-in leading-pro text-xs rounded-lg p-2 h-8 w-8 mx-0 my-auto inline-flex items-center justify-center cursor-pointer border-0 bg-blue-500 hover:bg-blue-600 text-white shadow-md transition-all">
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-center py-8">
                                <i class="fa-solid fa-inbox text-4xl text-slate-300 mb-3"></i>
                                <p class="text-slate-500 dark:text-white/60">Không có đơn hàng đang chờ</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script cho Biểu Đồ -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dữ liệu từ Laravel
            const monthLabels = @json($viewData['monthLabels']);
            const revenueData = @json($viewData['revenueData']);
            
            // Tạo biểu đồ
            const ctx = document.getElementById('revenueChart');
            if (ctx) {
                const revenueChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: monthLabels,
                        datasets: [{
                            label: 'Doanh Thu (₫)',
                            data: revenueData,
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            borderColor: 'rgba(16, 185, 129, 1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: 'rgba(16, 185, 129, 1)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            pointHoverBackgroundColor: 'rgba(16, 185, 129, 1)',
                            pointHoverBorderColor: '#fff',
                            pointHoverBorderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    color: '#64748b',
                                    font: {
                                        size: 12,
                                        weight: '600'
                                    },
                                    padding: 15,
                                    usePointStyle: true
                                }
                            },
                            tooltip: {
                                enabled: true,
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                borderColor: 'rgba(16, 185, 129, 1)',
                                borderWidth: 1,
                                padding: 12,
                                displayColors: true,
                                callbacks: {
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        label += new Intl.NumberFormat('vi-VN', {
                                            style: 'currency',
                                            currency: 'VND'
                                        }).format(context.parsed.y);
                                        return label;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: '#64748b',
                                    font: {
                                        size: 11
                                    },
                                    callback: function(value) {
                                        return new Intl.NumberFormat('vi-VN', {
                                            notation: 'compact',
                                            compactDisplay: 'short'
                                        }).format(value) + ' ₫';
                                    }
                                },
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)',
                                    drawBorder: false
                                }
                            },
                            x: {
                                ticks: {
                                    color: '#64748b',
                                    font: {
                                        size: 11
                                    }
                                },
                                grid: {
                                    display: false,
                                    drawBorder: false
                                }
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        }
                    }
                });
            }
        });
    </script>
@endsection
