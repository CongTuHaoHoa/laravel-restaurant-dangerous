@extends('layouts.admin')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 wrap-break-word bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-center">
                    <h6 class="dark:text-white grow">Danh mục</h6>
                    <a href="{{ route('category.new') }}" class="inline-block px-2 py-2 mb-2 text-xs font-bold leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-success bg-150 hover:shadow-xs"><i class="fa-solid fa-plus mr-2"></i> Thêm danh mục mới</a>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2 grow">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                            <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tên</th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Màu sắc</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Ngày cập nhật</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Ngày tạo</th>
                                <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none dark:border-white/40 dark:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($viewData['categories'] as $category)
                                <tr>
                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $category->CTG_NAME }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ $category->CTG_COLOR }}</p>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $category->CTG_UPDATED_AT->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $category->CTG_CREATED_AT->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="p-2 bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <div class=" flex float-right px-2 gap-1">
                                            <a href="" class="inline-block px-3 py-2 leading-normal text-center text-white transition-all ease-in rounded-lg shadow-md bg-warning bg-150 hover:shadow-xs"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <button class="inline-block px-3 py-2 leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-danger bg-150 hover:shadow-xs"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class=" flex justify-center px-2 gap-1">

                <a href="{{ $viewData['categories']->url(1) }}" class="inline-block px-3 py-2 leading-normal text-center transition-all ease-in rounded-lg shadow-md fw-bolder bg-150 hover:shadow-xs {{ $viewData['categories']->onFirstPage() ? 'pointer-events-none opacity-50 cursor-not-allowed' : '' }}">
                    <i class="fa-solid fa-angles-left"></i>
                </a>
                <a href="{{ $viewData['categories']->previousPageUrl() }}" class="inline-block px-3 py-2 leading-normal text-center transition-all ease-in rounded-lg shadow-md fw-bolder bg-150 hover:shadow-xs {{ $viewData['categories']->onFirstPage() ? 'pointer-events-none opacity-50 cursor-not-allowed' : '' }}">
                    <i class="fa-solid fa-angle-left"></i>
                </a>

                @php

                    $current = $viewData['categories']->currentPage();
                    $last = $viewData['categories']->lastPage();
                    $start = max($current - 2, 1);
                    $end = min($start + 4, $last);

                    if ($end - $start < 4)  $start = max($end - 4, 1);

                @endphp

                @for($i = $start; $i <= $end; $i++)
                    <a href="{{ $viewData['categories']->url($i) }}" class="inline-block px-3 py-2 leading-normal text-center {{ $i == $viewData['categories']->currentPage() ? 'bg-blue-500 text-white' : 'text-blue-500' }} transition-all ease-in rounded-lg shadow-md fw-bolder bg-150 hover:shadow-xs">{{ $i  }}</a>
                @endfor

                <a href="{{ $viewData['categories']->nextPageUrl() }}" class="inline-block px-3 py-2 leading-normal text-center transition-all ease-in rounded-lg shadow-md fw-bolder bg-150 hover:shadow-xs {{ !$viewData['categories']->hasMorePages() ? 'pointer-events-none opacity-50 cursor-not-allowed' : '' }}">
                    <i class="fa-solid fa-angle-right"></i>
                </a>
                <a href="{{ $viewData['categories']->url($last) }}" class="inline-block px-3 py-2 leading-normal text-center transition-all ease-in rounded-lg shadow-md fw-bolder bg-150 hover:shadow-xs {{ !$viewData['categories']->hasMorePages() ? 'pointer-events-none opacity-50 cursor-not-allowed' : '' }}">
                    <i class="fa-solid fa-angles-right"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
