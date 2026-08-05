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
                    <a class="py-2.7 {{ $viewData['activate'] == 'food' ? 'bg-blue-500/13 font-semibold text-slate-700' : '' }} dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 transition-colors" href="{{ route('food.index')  }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-orange-500 fa-solid fa-utensils"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Món ăn</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ $viewData['activate'] == 'order' ? 'bg-blue-500/13 font-semibold text-slate-700' : '' }} dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 transition-colors" href="{{ route('admin.order') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-emerald-500 fa-solid fa-bag-shopping"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Đơn hàng</span>
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
                    <a class="py-2.7 {{ $viewData['activate'] == 'employee' ? 'bg-blue-500/13 font-semibold text-slate-700' : '' }} dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 transition-colors" href="{{ route('admin.employee') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-red-600 fa-solid fa-people-group"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Tài khoản</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="mx-4 ">
            <!-- load phantom colors for card after: -->
            <p class="invisible hidden text-gray-800 text-red-500 text-red-600 text-blue-500 bg-gray-500/30 bg-cyan-500/30 bg-emerald-500/30 bg-orange-500/30 bg-red-500/30 after:bg-gradient-to-tl after:from-zinc-800 after:to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 after:from-blue-700 after:to-cyan-500 after:from-orange-500 after:to-yellow-500 after:from-green-600 after:to-lime-400 after:from-red-600 after:to-orange-600 after:from-slate-600 after:to-slate-300 text-emerald-500 text-cyan-500 text-slate-400"></p>
            <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border" sidenav-card>
                <img class="w-1/2 mx-auto" src="{{ asset('/img/admin/illustrations/icon-documentation.svg') }}" alt="sidebar illustrations" />
                <div class="flex-auto w-full p-4 pt-0 text-center">
                    <div class="transition-all duration-200 ease-nav-brand">
                        <h6 class="mb-0 dark:text-white text-slate-700">Tên người dùng</h6>
                    </div>
                </div>
            </div>
            <a href="{{ route('client.index') }}" class="inline-block w-full px-8 py-2 mb-2 text-xs font-bold leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-blue-500 bg-150 hover:shadow-xs hover:-translate-y-px">Về trang chính</a>
        </div>
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
