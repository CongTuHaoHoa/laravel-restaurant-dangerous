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
                                <i class="fa-solid fa-floppy-disk mr-2"></i>
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
                                <div class="mb-4">
                                    <label class="inline-block mb-3 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Hình ảnh món ăn</label>
                                    <div id="drop-zone" class="relative group">
                                        <div class="relative overflow-hidden bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-850 border-2 border-dashed border-slate-300 dark:border-slate-600 rounded-2xl transition-all duration-300 hover:border-blue-400 dark:hover:border-blue-500 hover:shadow-lg" style="min-height: 320px;">
                                            <!-- Preview Image -->
                                            <img id="food-image-previewer" class="absolute inset-0 w-full h-full object-cover rounded-2xl z-10" src="{{ asset('/storage/food/'.$viewData['food']->FOD_IMAGE) }}" alt="{{ $viewData['food']->FOD_NAME }}"/>
                                            
                                            <!-- Upload Placeholder (Hidden initially since we have image) -->
                                            <div id="upload-placeholder" class="hidden flex-col items-center justify-center h-full p-8 text-center">
                                                <div class="w-24 h-24 mb-4 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                                    <i class="fas fa-cloud-upload-alt text-white text-4xl"></i>
                                                </div>
                                                <h3 class="text-lg font-bold text-slate-700 dark:text-white mb-2">Tải hình ảnh lên</h3>
                                                <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">Kéo thả hoặc click để chọn file</p>
                                                <div class="flex items-center gap-2 text-xs text-slate-400">
                                                    <i class="fas fa-info-circle"></i>
                                                    <span>PNG, JPG, JPEG (tối đa 5MB)</span>
                                                </div>
                                            </div>

                                            <!-- Change Image Button (Appears on Hover) -->
                                            <div id="change-image-overlay" class="flex absolute inset-0 bg-black bg-opacity-50 items-center justify-center z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl">
                                                <div class="text-center">
                                                    <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-white flex items-center justify-center">
                                                        <i class="fas fa-camera text-blue-600 text-2xl"></i>
                                                    </div>
                                                    <p class="text-white font-semibold">Thay đổi hình ảnh</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Hidden File Input -->
                                        <input id="FOD_IMAGE" name="FOD_IMAGE" accept="image/*" type="file" class="hidden"/>
                                    </div>
                                    <div id="file-info" class="hidden mt-3 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <i class="fas fa-file-image text-blue-600 text-xl"></i>
                                                <div>
                                                    <p id="file-name" class="text-sm font-semibold text-slate-700 dark:text-white"></p>
                                                    <p id="file-size" class="text-xs text-slate-500 dark:text-slate-400"></p>
                                                </div>
                                            </div>
                                            <button type="button" id="remove-image" class="text-red-500 hover:text-red-700 transition-colors">
                                                <i class="fas fa-times-circle text-xl"></i>
                                            </button>
                                        </div>
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
        const input = document.getElementById('FOD_IMAGE');
        const preview = document.getElementById('food-image-previewer');
        const dropZone = document.getElementById('drop-zone');
        const placeholder = document.getElementById('upload-placeholder');
        const changeOverlay = document.getElementById('change-image-overlay');
        const fileInfo = document.getElementById('file-info');
        const fileName = document.getElementById('file-name');
        const fileSize = document.getElementById('file-size');
        const removeBtn = document.getElementById('remove-image');
        const originalSrc = preview.src; // Save original image

        // Click to upload
        dropZone.addEventListener('click', () => input.click());

        // Drag and drop
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-blue-500', 'bg-blue-50');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-blue-500', 'bg-blue-50');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-blue-500', 'bg-blue-50');
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                handleFile(file);
            }
        });

        // File input change
        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) handleFile(file);
        });

        // Remove image (restore original)
        removeBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            input.value = '';
            preview.src = originalSrc;
            fileInfo.classList.add('hidden');
        });

        function handleFile(file) {
            // Check file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert('File quá lớn! Vui lòng chọn file nhỏ hơn 5MB.');
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                
                // Show file info
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);
                fileInfo.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
        }
    </script>
@endsection
