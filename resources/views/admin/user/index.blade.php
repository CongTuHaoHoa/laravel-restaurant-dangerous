@extends('layouts.admin')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 wrap-break-word bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-center">
                    <h6 class="dark:text-white grow">Người dùng</h6>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2 grow">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                            <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tên</th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Mail</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Số điện thoại</th>
                                <th class="px-6 py-3 font-bold text-right uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Số dư tài khoản</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Vai trò</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Ngày cập nhật</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Ngày tạo</th>
                                <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none dark:border-white/40 dark:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($viewData['users'] as $user)
                                <tr>
                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <div>
                                                <img src="{{ asset('/storage/user/'.$user->avatar) }}" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl" alt="user1" />
                                            </div>
                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $user->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ $user->email }}</p>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ $user->phone_number }}</p>
                                    </td>
                                    <td class="p-2 text-right align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ number_format($user->balance, 0, ',', '.') }}</p>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <span style="background: {{ $user->role == 'admin' ? '#DC2626' : '#374151' }}" class="to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">{{ $user->role }}</span>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $user->updated_at->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $user->created_at->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="p-2 bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <div class=" flex float-right px-2 gap-1">
                                            <button type="button" onclick="this.closest('td').querySelector('.deposit-modal').classList.remove('hidden')" class="inline-block px-3 py-2 leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-success bg-150 hover:shadow-xs"><i class="fa-solid fa-credit-card"></i></button>
                                            <form method="POST" action="{{ route('user.role', $user->id) }}" onsubmit="return confirm('Bạn có muốn {{ $user->role == 'admin' ? 'hạ' : 'nâng'  }} {{ $user->name }} {{ $user->role == 'admin' ? 'xuống vai trò client' : 'lên vai trò admin'  }}?')">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" style="background: {{ $user->role == 'client' ? '#DC2626' : '#374151' }}" class="inline-block px-3 py-2 leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-150 hover:shadow-xs"><i class="fa-solid fa-{{ $user->role == 'admin' ? 'lock' : 'lock-open' }}"></i></button>
                                            </form>
                                            <form method="POST" action="{{ route('user.money', $user->id) }}">
                                                @csrf
                                                <div style="background: #11111160; z-index: 9999" class="deposit-modal flex hidden fixed top-0 bottom-0 left-0 right-0 align-items-center justify-content-center">
                                                    <div class="w-25 h-25 px-3 bg-white rounded-2 flex-col flex gap-2 align-items-center justify-content-center">
                                                        <label for="money" class="inline-block mb-2 ml-1 font-bold text-xl text-slate-700 dark:text-white/80">Nạp tiền</label>
                                                        <input id="money" type="number" name="money" placeholder="Nhập số tiền" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                                        <div class="flex flex-row gap-1">
                                                            <button type="button" onclick="this.closest('.deposit-modal').classList.add('hidden')" class="inline-block px-3 py-2 leading-normal text-center text-secondary capitalize border-1 border-secondary transition-all ease-in rounded-lg shadow-md bg-150 hover:shadow-xs fw-bolder">Huỷ bỏ</button>
                                                            <button type="submit"  class="inline-block px-3 py-2 leading-normal text-center bg-success text-white capitalize transition-all ease-in rounded-lg shadow-md bg-150 hover:shadow-xs fw-bolder">Xác nhận</button>
                                                        </div>
                                                    </div>
                                                </div>
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
            <div class=" flex justify-center px-2 gap-1">

                <a href="{{ $viewData['users']->url(1) }}" class="inline-block px-3 py-2 leading-normal text-center transition-all ease-in rounded-lg shadow-md fw-bolder bg-150 hover:shadow-xs {{ $viewData['users']->onFirstPage() ? 'pointer-events-none opacity-50 cursor-not-allowed' : '' }}">
                    <i class="fa-solid fa-angles-left"></i>
                </a>
                <a href="{{ $viewData['users']->previousPageUrl() }}" class="inline-block px-3 py-2 leading-normal text-center transition-all ease-in rounded-lg shadow-md fw-bolder bg-150 hover:shadow-xs {{ $viewData['users']->onFirstPage() ? 'pointer-events-none opacity-50 cursor-not-allowed' : '' }}">
                    <i class="fa-solid fa-angle-left"></i>
                </a>

                @php
                    $current = $viewData['users']->currentPage();
                    $last = $viewData['users']->lastPage();
                    $start = max($current - 2, 1);
                    $end = min($start + 4, $last);

                    if ($end - $start < 4)  $start = max($end - 4, 1);

                @endphp

                @for($i = $start; $i <= $end; $i++)
                    <a href="{{ $viewData['users']->url($i) }}" class="inline-block px-3 py-2 leading-normal text-center {{ $i == $viewData['users']->currentPage() ? 'bg-blue-500 text-white' : 'text-blue-500' }} transition-all ease-in rounded-lg shadow-md fw-bolder bg-150 hover:shadow-xs">{{ $i  }}</a>
                @endfor

                <a href="{{ $viewData['users']->nextPageUrl() }}" class="inline-block px-3 py-2 leading-normal text-center transition-all ease-in rounded-lg shadow-md fw-bolder bg-150 hover:shadow-xs {{ !$viewData['users']->hasMorePages() ? 'pointer-events-none opacity-50 cursor-not-allowed' : '' }}">
                    <i class="fa-solid fa-angle-right"></i>
                </a>
                <a href="{{ $viewData['users']->url($last) }}" class="inline-block px-3 py-2 leading-normal text-center transition-all ease-in rounded-lg shadow-md fw-bolder bg-150 hover:shadow-xs {{ !$viewData['users']->hasMorePages() ? 'pointer-events-none opacity-50 cursor-not-allowed' : '' }}">
                    <i class="fa-solid fa-angles-right"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
