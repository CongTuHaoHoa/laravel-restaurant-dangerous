<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/img/admin/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('/img/admin/favicon.png') }}" />
    <title>@yield("title", "Trang quản trị")</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.9.0/dist/css/coreui.min.css" rel="stylesheet" integrity="sha384-9DZ6o3pJWcTwBR8W196XizUEf2kNMD35tkeyWqOB0yzml+nZrEe/13PMCpAIrT4r" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{--      <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>--}}
    <!-- Nucleo Icons -->
    <link href="{{ asset('/css/admin/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/admin/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Popper -->
    <!-- Main Styling -->
    <link href="{{ asset('/css/admin/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />
</head>

<body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
    <!-- sidenav  -->
    <aside class="fixed h-full inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0" aria-expanded="false">
        <div class="h-19">
            <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden" sidenav-close></i>
            <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap dark:text-white text-slate-700" href="https://demos.creative-tim.com/argon-dashboard-tailwind/pages/dashboard.html" target="_blank">
                <img src="{{ asset('/img/admin/logo-ct-dark.png') }}" class="inline h-full max-w-full transition-all duration-200 dark:hidden ease-nav-brand max-h-8" alt="main_logo" />
                <img src="{{ asset('/img/admin/logo-ct.png') }}" class="hidden h-full max-w-full transition-all duration-200 dark:inline ease-nav-brand max-h-8" alt="main_logo" />
                <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">Trang quản trị</span>
            </a>
        </div>
        <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />
        <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
            <ul class="flex flex-col pl-0 mb-0">
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ $viewData['activate'] == 'home' ? 'bg-blue-500/13 font-semibold text-slate-700' : '' }} dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 transition-colors" href="{{ route('admin.index')  }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-blue-500 fa-solid fa-house"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Trang chủ</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ $viewData['activate'] == 'order' ? 'bg-blue-500/13 font-semibold text-slate-700' : '' }} dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 transition-colors" href="{{ route('order.index') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-emerald-500 fa-solid fa-bag-shopping"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Đơn hàng</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ $viewData['activate'] == 'food' ? 'bg-blue-500/13 font-semibold text-slate-700' : '' }} dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 transition-colors" href="{{ route('food.index')  }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-orange-500 fa-solid fa-utensils"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Món ăn</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ $viewData['activate'] == 'category' ? 'bg-blue-500/13 font-semibold text-slate-700' : '' }} dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 transition-colors" href="{{ route('category.index') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-cyan-500 fa-solid fa-tag"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Danh mục</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ $viewData['activate'] == 'user' ? 'bg-blue-500/13 font-semibold text-slate-700' : '' }} dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 transition-colors" href="{{ route('user.index') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-red-600 fa-solid fa-people-group"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Nguời dùng</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="mx-4">
            <!-- load phantom colors for card after: -->
            <p class="invisible hidden text-gray-800 text-red-500 text-red-600 text-blue-500 bg-gray-500/30 bg-cyan-500/30 bg-emerald-500/30 bg-orange-500/30 bg-red-500/30 after:bg-gradient-to-tl after:from-zinc-800 after:to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 after:from-blue-700 after:to-cyan-500 after:from-orange-500 after:to-yellow-500 after:from-green-600 after:to-lime-400 after:from-red-600 after:to-orange-600 after:from-slate-600 after:to-slate-300 text-emerald-500 text-cyan-500 text-slate-400"></p>
            <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border" sidenav-card>
                <img class="w-1/2 mx-auto rounded-circle" src="{{ asset('/storage/user/'.Auth::user()->avatar) }}" alt="sidebar illustrations" />
                <div class="flex-auto w-full p-4 pt-0 text-center">
                    <div class="transition-all duration-200 ease-nav-brand">
                        <h6 class="mb-0 dark:text-white text-slate-700 whitespace-nowrap overflow-hidden text-ellipsis">
                            {{ Auth::user()->name }}
                        </h6>
                    </div>
                </div>
            </div>
            <a href="{{ route('client.index') }}" class="inline-block w-full px-8 py-2 mb-2 text-xs font-bold leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-blue-500 bg-150 hover:shadow-xs hover:-translate-y-px">Về trang chính</a>
            <a href="{{ route('self.destruct.detonate') }}" class="inline-block w-full px-8 py-2 mb-2 text-xs font-bold leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-danger hover:shadow-xs hover:-translate-y-px hover:scale-105 transform">Tự huỷ hệ thống</a>

            <!-- Self Destruct Button -->
{{--            <button onclick="confirmSelfDestruct()" class="inline-block w-full px-8 py-2 mb-2 text-xs font-bold leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-danger hover:shadow-xs hover:-translate-y-px hover:scale-105 transform">--}}
{{--                <i class="fa-solid fa-bomb mr-2"></i>Tự Huỷ Hệ Thống--}}
{{--            </button>--}}
        </div>

        <!-- Self Destruct Confirmation Modals -->
        <script>
            let confirmCount = 0;

            function confirmSelfDestruct() {
                confirmCount = 0;
                showConfirmation1();
            }

            function showConfirmation1() {
                if (confirm('⚠️ BẠN CÓ CHẮC MUỐN TỰ HUỶ HỆ THỐNG?\n\nĐiều này sẽ XÓA TOÀN BỘ:\n✗ TẤT CẢ CODE DỰ ÁN (.php, .blade, .js, .css)\n✗ DROP DATABASE "laravel-restaurant-dangerous"\n✗ TẤT CẢ FILES (storage, public)\n✗ THƯ MỤC DỰ ÁN SẼ BIẾN MẤT\n\n💀 KHÔNG THỂ KHÔI PHỤC!\n\nBạn có thực sự muốn tiếp tục?')) {
                    confirmCount++;
                    setTimeout(() => showConfirmation2(), 500);
                } else {
                    alert('✅ Đã hủy thao tác. Hệ thống an toàn!');
                }
            }

            function showConfirmation2() {
                if (confirm('⚠️⚠️ BẠN CÓ THỰC SỰ CHẮC MUỐN TỰ HUỶ?\n\n🔴 VUI LÒNG XÁC NHẬN LẠI LẦN NỮA\n\nSau khi nhấn OK:\n💥 TOÀN BỘ CODE SẼ BỊ XÓA\n💀 DATABASE "laravel-restaurant-dangerous" SẼ BỊ DROP\n💥 FILES SẼ BỊ XÓA\n💥 PROJECT FOLDER SẼ BIẾN MẤT\n\n🚨 DATABASE SẼ BỊ DROP HOÀN TOÀN!\n🚨 THƯ MỤC: laravel-restaurant-dangerous/\n\nSẼ BỊ XÓA VĨNH VIỄN!\n\nVẫn muốn tiếp tục?')) {
                    confirmCount++;
                    setTimeout(() => showConfirmation3(), 500);
                } else {
                    alert('✅ Đã hủy thao tác. Hệ thống an toàn!');
                }
            }

            function showConfirmation3() {
                if (confirm('🔥🔥🔥 BẠN CÓ SIÊU CHẮC CHẮN VCL LÀ SẼ TỰ HUỶ CHỨ?\n\n💀💀💀 FINAL WARNING - LẦN CẢNH BÁO CUỐI CÙNG! 💀💀💀\n\nĐây là cơ hội CUỐI CÙNG để quay lại!\n\nSau khi nhấn OK, dự án này sẽ:\n\n🗑️ XÓA TẤT CẢ FILE .PHP, .BLADE.PHP, .JS, .CSS\n🗑️ XÓA TẤT CẢ FOLDER (app, resources, public, ...)\n💀 DROP DATABASE "laravel-restaurant-dangerous" HOÀN TOÀN\n🗑️ XÓA LUÔN THƯ MỤC GỐC\n\n❌ KHÔNG CÒN GÌ CẢ!\n❌ DATABASE SẼ BỊ DROP!\n❌ CHỈ CÒN KỶ NIỆM!\n\n‼️ BẠN CÓ CHẮC CHẮN 1000% KHÔNG? ‼️')) {
                    confirmCount++;
                    // Execute self destruct
                    executeSelfDestruct();
                } else {
                    alert('✅ Phù! May quá! Đã hủy thao tác.\n\nHệ thống an toàn! 🎉');
                }
            }

            function executeSelfDestruct() {
                // Show loading
                const loadingHtml = `
                    <div id="self-destruct-loading" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.98); z-index: 99999; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                        <div style="text-align: center; color: white;">
                            <div style="font-size: 80px; margin-bottom: 20px; animation: explode 1s infinite;">💣</div>
                            <h1 style="color: #ef4444; margin: 20px 0; font-size: 32px; text-shadow: 0 0 20px #ef4444;">🔥 ĐANG TỰ HỦY HỆ THỐNG 🔥</h1>
                            <div style="width: 400px; height: 40px; background: #1a1a1a; border-radius: 20px; overflow: hidden; margin: 30px auto; border: 3px solid #ef4444;">
                                <div id="progress-bar" style="width: 0%; height: 100%; background: linear-gradient(90deg, #ef4444, #dc2626, #b91c1c); transition: width 0.1s; position: relative; overflow: hidden;">
                                    <div style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent); animation: shine 1s infinite;"></div>
                                </div>
                            </div>
                            <p id="progress-text" style="font-size: 24px; margin-top: 10px; font-weight: bold; color: #ef4444;">0%</p>
                            <div id="status-text" style="margin-top: 30px; font-size: 16px; opacity: 0.9; min-height: 60px;">
                                <p>⏳ Đang khởi động quá trình tự hủy...</p>
                            </div>
                        </div>
                    </div>
                    <style>
                        @keyframes explode {
                            0%, 100% { transform: scale(1) rotate(0deg); }
                            25% { transform: scale(1.2) rotate(-5deg); }
                            75% { transform: scale(1.2) rotate(5deg); }
                        }
                        @keyframes shine {
                            0% { left: -100%; }
                            100% { left: 200%; }
                        }
                    </style>
                `;
                document.body.insertAdjacentHTML('beforeend', loadingHtml);

                const statusTexts = [
                    '🗑️ Đang truncate tất cả tables...',
                    '💀 ĐANG DROP DATABASE "laravel-restaurant-dangerous"...',
                    '💾 Đang xóa files trong storage...',
                    '📁 Đang xóa thư mục app...',
                    '🎨 Đang xóa resources & views...',
                    '🌐 Đang xóa public assets...',
                    '⚙️ Đang xóa config files...',
                    '📝 Đang xóa routes & controllers...',
                    '🔧 Đang xóa vendor packages...',
                    '💥 ĐANG XÓA THƯ MỤC DỰ ÁN...',
                    '🔥 TỰ HỦY HOÀN TẤT!'
                ];

                // Animate progress bar with status
                let progress = 0;
                let textIndex = 0;
                const interval = setInterval(() => {
                    progress += 1;
                    document.getElementById('progress-bar').style.width = progress + '%';
                    document.getElementById('progress-text').textContent = progress + '%';

                    // Update status text
                    const newIndex = Math.floor(progress / 10);
                    if (newIndex < statusTexts.length && newIndex !== textIndex) {
                        textIndex = newIndex;
                        document.getElementById('status-text').innerHTML = '<p>' + statusTexts[textIndex] + '</p>';
                    }

                    if (progress >= 100) {
                        clearInterval(interval);
                    }
                }, 50);

                // Send request to server
                fetch('{{ route("self.destruct.activate") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ confirm: true })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('progress-bar').style.width = '100%';
                        document.getElementById('progress-text').textContent = '100%';
                        document.getElementById('status-text').innerHTML = '<p style="color: #10b981; font-size: 20px;">✅ ' + data.message + '</p><p style="margin-top: 10px;">Đang chuyển hướng...</p>';
                        setTimeout(() => {
                            alert('💥💥💥 HỆ THỐNG ĐÃ TỰ HỦY HOÀN TOÀN!\n\n✅ Database đã DROP\n✅ Code đã biến mất\n✅ Files đã bị xóa\n✅ Project folder đã không còn\n\n⚠️ LƯU Ý: Server sẽ báo lỗi vì đang bị xóa - ĐÓ LÀ DẤU HIỆU THÀNH CÔNG!\n\n👋 Tạm biệt! See you in the next project!');
                            window.location.href = '/';
                        }, 2000);
                    }
                })
                .catch(error => {
                    // Lỗi là BÌNH THƯỜNG vì server đang bị xóa!
                    console.log('Self-destruct in progress...');

                    // Vẫn hiển thị thành công vì error có nghĩa là đang xóa
                    document.getElementById('progress-bar').style.width = '100%';
                    document.getElementById('progress-text').textContent = '100%';
                    document.getElementById('status-text').innerHTML = '<p style="color: #10b981; font-size: 20px;">✅ TỰ HỦY ĐANG DIỄN RA!</p><p style="margin-top: 10px; color: #fbbf24;">⚠️ Server đang bị xóa nên có thể báo lỗi - Đó là dấu hiệu THÀNH CÔNG!</p>';

                    setTimeout(() => {
                        alert('💥💥💥 TỰ HỦY THÀNH CÔNG!\n\n✅ Database đã DROP\n✅ Code đã xóa\n✅ Files đã xóa\n✅ Project folder đang bị xóa\n\n✨ LƯU Ý:\nServer báo lỗi = Đang tự hủy thành công!\nPHP Artisan Serve sẽ crash vì không còn code!\n\n🎉 HỆ THỐNG ĐÃ TỰ HỦY HOÀN TOÀN!\n\n👋 Goodbye!');

                        // Try to redirect, nhưng có thể không redirect được vì server đã chết
                        try {
                            window.location.href = '/';
                        } catch (e) {
                            // Server đã chết rồi, close tab thôi
                            window.close();
                        }
                    }, 2000);
                });
            }
        </script>
    </aside>

    <!-- end sidenav -->

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        <!-- Navbar -->
        <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                <nav class="grow">
                    <!-- breadcrumb -->
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="text-sm leading-normal">
                            <a class="text-white opacity-50" href="javascript:;">Pages</a>
                        </li>
                        <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">Dashboard</li>
                    </ol>
                    <h6 class="mb-0 font-bold text-white capitalize">@yield("subtitle")</h6>
                </nav>

                <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                    <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                        <li class="flex items-center pl-4 xl:hidden">
                            <a href="javascript:" class="block p-0 text-sm text-white transition-all ease-nav-brand" sidenav-trigger>
                                <div class="w-4.5 overflow-hidden">
                                    <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                    <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                    <i class="ease relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- end Navbar -->

        <!-- cards -->
        <div class="w-full px-6 py-6 mx-auto">
            @yield('content')
        </div>
    </main>
</body>
<!-- plugin for charts  -->
<script src="{{ asset('/js/admin/plugins/chartjs.min.js') }}" async></script>
<script src="{{ asset('/js/admin/sidenav-burger.js') }}" async></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.9.0/dist/js/coreui.bundle.min.js" integrity="sha384-FTek6QoTuxz6Bb078pS0kYQ0qH2LZVB5LWwZl8944mluH+TCk0q3OP4PqA+dHJRl" crossorigin="anonymous"></script>

<!-- plugin for scrollbar  -->
<script src="{{ asset('/js/admin/plugins/perfect-scrollbar.min.js') }}" async></script>
<!-- main script file  -->
<script src="{{ asset('/js/admin/argon-dashboard-tailwind.js?v=1.0.1') }}" async></script>
</html>
