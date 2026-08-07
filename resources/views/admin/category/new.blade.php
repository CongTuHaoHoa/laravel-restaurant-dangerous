@extends('layouts.admin')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    <form action="{{ route('category.index') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="w-full p-6 mx-auto">
            <div class="flex flex-wrap -mx-3">
                <div class="relative flex flex-col min-w-0 wrap-break-word bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border w-full">
                    <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                        <div class="flex items-center">
                            <a href="{{ route('category.index') }}" class="inline-block px-3 mb-2 mr-4 py-2 text-xs font-bold leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-secondary bg-150 hover:shadow-xs"><i class="fa-solid fa-arrow-left"></i></a>
                            <p class="dark:text-white/80 mb-2 grow">Thêm danh mục mới</p>
                            <button type="submit" class="block mb-2 w-max px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-success tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
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
                                    <input id="CTG_NAME" type="text" name="CTG_NAME" placeholder="Nhập tên danh mục" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                                <div class="mb-4">
                                    <label for="CTG_COLOR" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Màu sắc</label>
                                    <select name="CTG_COLOR" class="form-select" aria-label="Default select example">
                                        <option value="FF6B35" style="background: #FF6B35" class="to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            #FF6B35
                                        </option>
                                        <option value="FF69B4" style="background: #FF69B4" class="to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            #FF69B4
                                        </option>
                                        <option value="2563EB" style="background: #2563EB" class="to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            #2563EB
                                        </option>
                                        <option value="14B8A6" style="background: #14B8A6" class="to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            #14B8A6
                                        </option>
                                        <option value="7C3AED" style="background: #7C3AED" class="to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            #7C3AED
                                        </option>
                                        <option value="DC2626" style="background: #DC2626" class="to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            #DC2626
                                        </option>
                                        <option value="D97706" style="background: #D97706" class="to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            #D97706
                                        </option>
                                        <option value="16A34A" style="background: #16A34A" class="to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            #16A34A
                                        </option>
                                        <option value="DB2777" style="background: #DB2777" class="to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            #DB2777
                                        </option>
                                        <option value="374151" style="background: #374151" class="to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            #374151
                                        </option>
                                        <option value="111827" style="background: #111827" class="to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            #111827
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="relative flex align-items-center flex-col min-w-0 wrap-break-word bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                                    <div style="width: 250px; height: 250px; position: relative" class="mt-3 mb-4 border-2 border-secondary border-solid rounded-2 flex align-items-center justify-content-center">
                                        <img id="category-image-previewer" class="z-2 img-thumbnail" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%"  src="{{ asset('storage/category/CTG_DEF.png') }}" alt="">
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
