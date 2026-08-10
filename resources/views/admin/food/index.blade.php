@extends('layouts.admin')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    <div class="flex flex-col min-h-[calc(100vh-200px)]">
        <div class="flex flex-wrap -mx-3 flex-grow">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 wrap-break-word bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-center">
                        <h6 class="dark:text-white grow">Món ăn</h6>
                        <a href="{{ route('food.new') }}" class="inline-block px-2 py-2 mb-2 text-xs font-bold leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-success bg-150 hover:shadow-xs"><i class="fa-solid fa-plus mr-2"></i> Thêm món mới</a>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2 grow">
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                <thead class="align-bottom">
                                <tr>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tên</th>
                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Giá</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Danh mục</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Trạng thái</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Ngày cập nhật</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Ngày tạo</th>
                                    <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none dark:border-white/40 dark:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($viewData['foods'] as $food)
                                        <tr>
                                            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <div class="flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('/storage/food/'.$food->FOD_IMAGE) }}" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl" alt="user1" />
                                                    </div>
                                                    <div class="flex flex-col justify-center">
                                                        <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $food->FOD_NAME }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ number_format($food->FOD_PRICE, 0, ',', '.') }}</p>
                                            </td>
                                            <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <div class="flex gap-1 justify-content-center">
                                                    @foreach($food->getCategories as $category)
                                                        <span style="background: {{ '#'.$category->CTG_COLOR }}" class="to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">{{ $category->CTG_NAME }}</span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <span class="{{ $food->FOD_STATUS ? 'bg-gradient-to-tl from-emerald-500 to-teal-400' : 'bg-secondary' }} px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">{{ $food->FOD_STATUS ? 'Còn món' : 'Hết món' }}</span>
                                            </td>
                                            <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $food->FOD_UPDATED_AT->format('d/m/Y') }}</span>
                                            </td>
                                            <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $food->FOD_CREATED_AT->format('d/m/Y') }}</span>
                                            </td>
                                            <td class="p-2 bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <div class=" flex float-right px-2 gap-1">
                                                    <a href="{{ route('food.info', $food->FOD_ID) }}" class="inline-block px-3 py-2 leading-normal text-center text-white transition-all ease-in rounded-lg shadow-md bg-warning bg-150 hover:shadow-xs"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <form method="POST" action="{{ route('food.delete', $food->FOD_ID) }}" onsubmit="return confirm('Bạn có muốn xoá {{ $food->FOD_NAME }}?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-block px-3 py-2 leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-danger bg-150 hover:shadow-xs"><i class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination pinned to bottom -->
        <div class="mt-auto">
            <div class="bg-white dark:bg-slate-850 rounded-2xl shadow-xl p-4 mx-3">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-slate-600 dark:text-slate-400">
                        Hiển thị <span class="font-semibold text-slate-800 dark:text-white">{{ $viewData['foods']->firstItem() }}</span> 
                        đến <span class="font-semibold text-slate-800 dark:text-white">{{ $viewData['foods']->lastItem() }}</span> 
                        trong tổng số <span class="font-semibold text-slate-800 dark:text-white">{{ $viewData['foods']->total() }}</span> món ăn
                    </div>
                    
                    <div class="flex justify-center gap-1">
                        <a href="{{ $viewData['foods']->url(1) }}" class="inline-flex items-center justify-center w-10 h-10 leading-normal text-center transition-all ease-in rounded-lg shadow-md hover:shadow-lg {{ $viewData['foods']->onFirstPage() ? 'opacity-50 cursor-not-allowed bg-slate-100 text-slate-400' : 'bg-white hover:bg-slate-50 text-slate-700' }}">
                            <i class="fa-solid fa-angles-left"></i>
                        </a>
                        <a href="{{ $viewData['foods']->previousPageUrl() }}" class="inline-flex items-center justify-center w-10 h-10 leading-normal text-center transition-all ease-in rounded-lg shadow-md hover:shadow-lg {{ $viewData['foods']->onFirstPage() ? 'opacity-50 cursor-not-allowed bg-slate-100 text-slate-400' : 'bg-white hover:bg-slate-50 text-slate-700' }}">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>

                        @php
                            $current = $viewData['foods']->currentPage();
                            $last = $viewData['foods']->lastPage();
                            $start = max($current - 2, 1);
                            $end = min($start + 4, $last);
                            if ($end - $start < 4) $start = max($end - 4, 1);
                        @endphp

                        @for($i = $start; $i <= $end; $i++)
                            <a href="{{ $viewData['foods']->url($i) }}" class="inline-flex items-center justify-center w-10 h-10 text-sm font-semibold leading-normal text-center transition-all ease-in rounded-lg shadow-md hover:shadow-lg {{ $i == $viewData['foods']->currentPage() ? 'bg-blue-500 text-white' : 'bg-white hover:bg-slate-50 text-slate-700' }}">{{ $i }}</a>
                        @endfor

                        <a href="{{ $viewData['foods']->nextPageUrl() }}" class="inline-flex items-center justify-center w-10 h-10 leading-normal text-center transition-all ease-in rounded-lg shadow-md hover:shadow-lg {{ !$viewData['foods']->hasMorePages() ? 'opacity-50 cursor-not-allowed bg-slate-100 text-slate-400' : 'bg-white hover:bg-slate-50 text-slate-700' }}">
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                        <a href="{{ $viewData['foods']->url($last) }}" class="inline-flex items-center justify-center w-10 h-10 leading-normal text-center transition-all ease-in rounded-lg shadow-md hover:shadow-lg {{ !$viewData['foods']->hasMorePages() ? 'opacity-50 cursor-not-allowed bg-slate-100 text-slate-400' : 'bg-white hover:bg-slate-50 text-slate-700' }}">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
