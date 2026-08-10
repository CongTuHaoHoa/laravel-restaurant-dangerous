@extends('layouts.admin')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    <form action="{{ route('category.edit', $viewData['category']->CTG_ID) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="w-full p-6 mx-auto">
            <div class="flex flex-wrap -mx-3">
                <div class="relative flex flex-col min-w-0 wrap-break-word bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border w-full">
                    <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                        <div class="flex items-center">
                            <a href="{{ route('category.index') }}" class="inline-block px-3 mb-2 mr-4 py-2 text-xs font-bold leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-secondary bg-150 hover:shadow-xs"><i class="fa-solid fa-arrow-left"></i></a>
                            <p class="dark:text-white/80 mb-2 grow">{{ $viewData['category']->CTG_NAME }}</p>
                            <button type="submit" class="block mb-2 w-max px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-success tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                <i class="fa-solid fa-floppy-disk mr-2"></i>
                                Lưu lại
                            </button>
                        </div>
                    </div>
                    <div class="flex-auto p-6">
                        <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-sm">Thông tin danh mục</p>
                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="mb-4">
                                    <label for="CTG_NAME" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Tên danh mục</label>
                                    <input id="CTG_NAME" value="{{ $viewData['category']->CTG_NAME }}" type="text" name="CTG_NAME" placeholder="Nhập tên danh mục" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                                <div class="mb-4">
                                    <label for="CTG_COLOR" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Màu sắc</label>
                                    <select name="CTG_COLOR" class="form-select" aria-label="Default select example">
                                        <option value="FF6B35" {{ $viewData['category']->CTG_COLOR == 'FF6B35' ? 'selected' : '' }} style="background:#FF6B35;color:white">#FF6B35</option>
                                        <option value="FF69B4" {{ $viewData['category']->CTG_COLOR == 'FF69B4' ? 'selected' : '' }} style="background:#FF69B4;color:white">#FF69B4</option>
                                        <option value="2563EB" {{ $viewData['category']->CTG_COLOR == '2563EB' ? 'selected' : '' }} style="background:#2563EB;color:white">#2563EB</option>
                                        <option value="14B8A6" {{ $viewData['category']->CTG_COLOR == '14B8A6' ? 'selected' : '' }} style="background:#14B8A6;color:white">#14B8A6</option>
                                        <option value="7C3AED" {{ $viewData['category']->CTG_COLOR == '7C3AED' ? 'selected' : '' }} style="background:#7C3AED;color:white">#7C3AED</option>
                                        <option value="DC2626" {{ $viewData['category']->CTG_COLOR == 'DC2626' ? 'selected' : '' }} style="background:#DC2626;color:white">#DC2626</option>
                                        <option value="D97706" {{ $viewData['category']->CTG_COLOR == 'D97706' ? 'selected' : '' }} style="background:#D97706;color:white">#D97706</option>
                                        <option value="16A34A" {{ $viewData['category']->CTG_COLOR == '16A34A' ? 'selected' : '' }} style="background:#16A34A;color:white">#16A34A</option>
                                        <option value="DB2777" {{ $viewData['category']->CTG_COLOR == 'DB2777' ? 'selected' : '' }} style="background:#DB2777;color:white">#DB2777</option>
                                        <option value="374151" {{ $viewData['category']->CTG_COLOR == '374151' ? 'selected' : '' }} style="background:#374151;color:white">#374151</option>
                                        <option value="111827" {{ $viewData['category']->CTG_COLOR == '111827' ? 'selected' : '' }} style="background:#111827;color:white">#111827</option>
                                    </select>
                                </div>
                            </div>
                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="relative flex align-items-center flex-col min-w-0 wrap-break-word bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                                    <div style="width: 250px; height: 250px; position: relative" class="mt-3 mb-4 border-2 border-secondary border-solid rounded-2 flex align-items-center justify-content-center">
                                        <img id="category-image-previewer" class="z-2 img-thumbnail" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%"  src="{{ asset('/storage/category/'.$viewData['category']->CTG_IMAGE) }}" alt="{{ $viewData['category']->CTG_NAME }}">
                                        <i class="fas fa-utensils text-secondary" style="font-size: 120px;"></i>
                                    </div>
                                    <div class="border-black/12.5 rounded-t-2xl p-6 text-center pt-0 pb-6 lg:pt-2 lg:pb-4">
                                        <label class="block px-8 w-max py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-secondary tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                            Tải ảnh lên
                                            <input id="CTG_IMAGE" name="CTG_IMAGE" accept="image/*" style="clip: rect(0 0 0 0); clip-path: inset(50%); overflow: hidden; position: absolute; white-space: nowrap" type="file"/>
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
        const input = document.getElementById('CTG_IMAGE')
        const preview = document.getElementById('category-image-previewer')

        input.addEventListener('change', function()
        {
            const file = this.files[0]
            if (!file) return

            preview.src = URL.createObjectURL(file)
            preview.classList.remove('hidden')
        });
    </script>
@endsection
