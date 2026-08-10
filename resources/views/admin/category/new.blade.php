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
                                <div class="mb-4">
                                    <label class="inline-block mb-3 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Hình ảnh danh mục</label>
                                    <div id="drop-zone" class="relative group">
                                        <div class="relative overflow-hidden bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-850 border-2 border-dashed border-slate-300 dark:border-slate-600 rounded-2xl transition-all duration-300 hover:border-blue-400 dark:hover:border-blue-500 hover:shadow-lg" style="min-height: 320px;">
                                            <!-- Preview Image -->
                                            <img id="category-image-previewer" class="hidden absolute inset-0 w-full h-full object-cover rounded-2xl z-10" src="" alt="Preview"/>
                                            
                                            <!-- Upload Placeholder -->
                                            <div id="upload-placeholder" class="flex flex-col items-center justify-center h-full p-8 text-center">
                                                <div class="w-24 h-24 mb-4 rounded-full bg-gradient-to-br from-cyan-400 to-cyan-600 flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                                    <i class="fas fa-cloud-upload-alt text-white text-4xl"></i>
                                                </div>
                                                <h3 class="text-lg font-bold text-slate-700 dark:text-white mb-2">Tải hình ảnh lên</h3>
                                                <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">Kéo thả hoặc click để chọn file</p>
                                                <div class="flex items-center gap-2 text-xs text-slate-400">
                                                    <i class="fas fa-info-circle"></i>
                                                    <span>PNG, JPG, JPEG (tối đa 5MB)</span>
                                                </div>
                                            </div>

                                            <!-- Change Image Button -->
                                            <div id="change-image-overlay" class="hidden absolute inset-0 bg-black bg-opacity-50 items-center justify-center z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl">
                                                <div class="text-center">
                                                    <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-white flex items-center justify-center">
                                                        <i class="fas fa-camera text-cyan-600 text-2xl"></i>
                                                    </div>
                                                    <p class="text-white font-semibold">Thay đổi hình ảnh</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Hidden File Input -->
                                        <input id="CTG_IMAGE" name="CTG_IMAGE" accept="image/*" type="file" class="hidden"/>
                                    </div>
                                    <div id="file-info" class="hidden mt-3 p-3 bg-cyan-50 dark:bg-cyan-900/20 rounded-lg">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <i class="fas fa-file-image text-cyan-600 text-xl"></i>
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
        const input = document.getElementById('CTG_IMAGE');
        const preview = document.getElementById('category-image-previewer');
        const dropZone = document.getElementById('drop-zone');
        const placeholder = document.getElementById('upload-placeholder');
        const changeOverlay = document.getElementById('change-image-overlay');
        const fileInfo = document.getElementById('file-info');
        const fileName = document.getElementById('file-name');
        const fileSize = document.getElementById('file-size');
        const removeBtn = document.getElementById('remove-image');

        // Click to upload
        dropZone.addEventListener('click', () => input.click());

        // Drag and drop
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-cyan-500', 'bg-cyan-50');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-cyan-500', 'bg-cyan-50');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-cyan-500', 'bg-cyan-50');
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

        // Remove image
        removeBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            input.value = '';
            preview.src = '';
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
            changeOverlay.classList.add('hidden');
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
                changeOverlay.classList.remove('hidden');
                changeOverlay.style.display = 'flex';
                
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
