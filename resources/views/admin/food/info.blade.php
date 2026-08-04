@extends('layouts.admin')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    <form action="{{ route('food.edit', $viewData['food']->FOD_ID) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="w-full p-6 mx-auto">
            <div class="flex flex-wrap -mx-3">
                <div class="relative flex flex-col min-w-0 wrap-break-word bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border w-full">
                    <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                        <div class="flex items-center">
                            <a href="{{ route('food.index') }}" class="inline-block px-3 mb-2 mr-4 py-2 text-xs font-bold leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-secondary bg-150 hover:shadow-xs"><i class="fa-solid fa-arrow-left"></i></a>
                            <p class="dark:text-white/80 mb-2 grow">{{ $viewData['food']->FOD_NAME  }}</p>
                            <button type="submit" class="block mb-2 w-max px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-success tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                Lưu lại
                            </button>
                        </div>
                    </div>
                    <div class="flex-auto p-6">
                        <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-sm">Thông tin món ăn</p>
                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="mb-4">
                                    <label for="FOD_NAME" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Tên món</label>
                                    <input value="{{ $viewData['food']->FOD_NAME }}" id="FOD_NAME" type="text" name="FOD_NAME" placeholder="Nhập tên món ăn" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                            </div>
                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="mb-4">
                                    <label for="FOD_PRICE" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Giá tiền</label>
                                    <input value="{{ $viewData['food']->FOD_PRICE }}" id="FOD_PRICE" type="number" name="FOD_PRICE" placeholder="Nhập giá tiền" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                            </div>
                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="mb-4 rounded-2">
                                    <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">
                                        Danh mục
                                    </label>
                                    <div class="px-2 py-2 rounded-1.8 border-b-slate-50 border">
                                        @foreach(@$viewData['categories'] as $category)
                                            <div class="form-check flex align-items-center">
                                                <input @checked($viewData['food']->checkCategory($category->CTG_ID)) class="form-check-input mr-2" type="checkbox" id="{{ $category->CTG_ID }}" name="{{ $category->CTG_ID }}">
                                                <label class="form-check-label" for="{{ $category->CTG_ID }}">
                                                    <span style="background: {{ '#'.$category->CTG_COLOR }}" class="to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">{{ $category->CTG_NAME  }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="mb-4 flex align-items-center justify-between h-full">
                                    <label for="FOD_STATUS" class="inline-block ml-5 font-bold text-xs text-slate-700 dark:text-white/80">Hết món</label>
                                    <input checked="{{ $viewData['food']->FOD_STATUS }}" name="FOD_STATUS" class="mt-0.5 rounded-10 duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5 relative w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-zinc-700/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-blue-500/95 checked:bg-blue-500/95 checked:bg-none checked:bg-right" type="checkbox" />
                                    <label for="FOD_STATUS" class="inline-block mr-5 font-bold text-xs text-slate-700 dark:text-white/80">Còn món</label>
                                </div>
                            </div>
                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="mb-4">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="FOD_DESCRIPTION" name="FOD_DESCRIPTION" style="height: 100px">{{ $viewData['food']->FOD_DESCRIPTION }}</textarea>
                                        <label for="FOD_DESCRIPTION">Mô tả</label>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="relative flex align-items-center flex-col min-w-0 wrap-break-word bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                                    <div style="width: 250px; height: 250px; position: relative" class="mt-3 mb-4 border-2 border-secondary border-solid rounded-2 flex align-items-center justify-content-center">
                                        <img id="food-image-previewer" class="z-2 img-thumbnail" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%"  src="{{ asset('/storage/food/'.$viewData['food']->FOD_IMAGE) }}" alt="">
                                        <i class="fas fa-utensils text-secondary" style="font-size: 120px;"></i>
                                    </div>
                                    <div class="border-black/12.5 rounded-t-2xl p-6 text-center pt-0 pb-6 lg:pt-2 lg:pb-4">
                                        <label class="block px-8 w-max py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-secondary tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                            Tải ảnh lên
                                            <input id="FOD_IMAGE" name="FOD_IMAGE" accept="image/*" style="clip: rect(0 0 0 0); clip-path: inset(50%); overflow: hidden; position: absolute; white-space: nowrap" type="file"/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        const input = document.getElementById('FOD_IMAGE')
        const preview = document.getElementById('food-image-previewer')

        input.addEventListener('change', function()
        {
            const file = this.files[0]
            if (!file) return

            preview.src = URL.createObjectURL(file)
            preview.classList.remove('hidden')
        });
    </script>
@endsection
