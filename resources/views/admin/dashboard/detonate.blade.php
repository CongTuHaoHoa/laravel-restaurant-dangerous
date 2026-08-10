@extends('layouts.admin')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    <div class="detonate-fullscreen">
        <div class="main">
            <div class="grid"></div>
            <div class="warning"></div>
            <div class="base">
                <button id="activate">
                    <span></span>
                </button>
            </div>
            <div class="box opened" id="cover">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <span></span><span></span>
            </div>
            <div class="hinges"></div>
            <div class="text">
                CÔNG TẮC TỰ HUỶ
            </div>

            <!-- Warning Modal lần 1 - Khi mở hộp -->
            <div id="warning-modal-1" class="warning-modal">
                <div class="warning-modal-content">
                    <div class="warning-icon">⚠️</div>
                    <h2 class="warning-title">CẢNH BÁO NGUY HIỂM!</h2>
                    <div class="warning-message">
                        <p>Bạn đang cố gắng mở thiết bị tự huỷ hệ thống!</p>
                        <p class="danger-text">Hành động này có thể dẫn đến việc XÓA TOÀN BỘ HỆ THỐNG</p>
                        <ul class="warning-list">
                            <li>❌ Xóa tất cả code (.php, .blade, .js, .css)</li>
                            <li>❌ Drop database hoàn toàn</li>
                            <li>❌ Xóa tất cả files (storage, public)</li>
                            <li>❌ KHÔNG THỂ KHÔI PHỤC!</li>
                        </ul>
                    </div>
                    <div class="warning-buttons">
                        <button id="cancel-open-1" class="btn-cancel">HỦY BỎ</button>
                        <button id="continue-open-1" class="btn-danger">TIẾP TỤC</button>
                    </div>
                </div>
            </div>

            <!-- Warning Modal lần 2 - Khi nhấn nút activate -->
            <div id="warning-modal-2" class="warning-modal">
                <div class="warning-modal-content">
                    <div class="warning-icon warning-pulse">☠️</div>
                    <h2 class="warning-title">CẢNH BÁO LẦN CUỐI!</h2>
                    <div class="warning-message">
                        <p class="danger-text-large">BẠN THỰC SỰ MUỐN KÍCH HOẠT TỰ HUỶ?</p>
                        <p>Sau khi xác nhận, bạn có thể sẽ hối hận vĩnh viễn.</p>
                        <p class="warning-final">Hệ thống không khuyến khích bạn tiếp tục thực thi thao tác này với lời chân thành cao nhất</p>
                    </div>
                    <div class="warning-buttons">
                        <button id="cancel-activate-2" class="btn-cancel">TÔI CẦN SUY NGHĨ LẠI</button>
                        <button id="continue-activate-2" class="btn-danger">TÔI ĐÃ HIỂU</button>
                    </div>
                </div>
            </div>

            <div id="panel">
                <div id="msg">KÍCH HOẠT HỆ THỐNG TỰ HUỶ</div>
                <div id="countdown-wait" class="countdown-wait">
                    <div id="wait-time">00:20</div>
                    <div class="progress-bar-container">
                        <div id="progress-bar-wait" class="progress-bar-wait"></div>
                    </div>
                </div>
                <div id="time">9</div>
                <span id="abort">HUỶ KÍCH HOẠT</span>
                <span id="detonate" class="detonate-disabled" style="display: none;">KÍCH HOẠT</span>
            </div>
            <div id="turn-off"></div>
            <div id="closing"></div>
            <div id="restart"><button id="reload"></button></div>
            <div id="mute"></div>
            <audio id="alarm">
                <source src="https://josetxu.com/demos/sounds/self-destruct-count.mp3" type="audio/mpeg">
            </audio>
        </div>
    </div>
    <script>
        var theCount;
        var waitCount;
        var alarm = document.getElementById("alarm");
        var panel = document.getElementById("panel");
        var turnOff = document.getElementById("turn-off");
        var turnOffHor = document.getElementById("closing");
        var detonate = document.getElementById("detonate");
        var countdownWait = document.getElementById("countdown-wait");
        var waitTimeDisplay = document.getElementById("wait-time");
        var progressBarWait = document.getElementById("progress-bar-wait");
        var cover = document.getElementById("cover");
        var btn = document.getElementById("activate");
        var abort = document.getElementById("abort");
        var reload = document.getElementById("restart");
        var mute = document.getElementById("mute");

        var warningModal1 = document.getElementById("warning-modal-1");
        var warningModal2 = document.getElementById("warning-modal-2");
        var cancelOpen1 = document.getElementById("cancel-open-1");
        var continueOpen1 = document.getElementById("continue-open-1");
        var cancelActivate2 = document.getElementById("cancel-activate-2");
        var continueActivate2 = document.getElementById("continue-activate-2");

        var waitTime = 20;
        var detonateEnabled = false;

        alarm.volume = 0.25;
        var time = document.getElementById("time");

        // Đóng hộp ban đầu
        setTimeout(function () {
            cover.classList.remove("opened");
        }, 100);

        // Cảnh báo lần 1 - Khi click mở hộp (mỗi lần mở đều hiện cảnh báo)
        cover.addEventListener("click", function () {
            if (this.className == "box") {
                // Đang đóng, muốn mở -> luôn hiện warning
                warningModal1.classList.add("show");
            } else {
                // Đang mở, muốn đóng
                this.classList.remove("opened");
            }
        });

        // Nút hủy warning 1
        cancelOpen1.addEventListener("click", function() {
            warningModal1.classList.remove("show");
            // Giữ hộp đóng
        });

        // Nút tiếp tục warning 1
        continueOpen1.addEventListener("click", function() {
            warningModal1.classList.remove("show");
            cover.classList.add("opened");
        });

        // Cảnh báo lần 2 - Khi nhấn nút activate
        btn.addEventListener("click", function () {
            if (!btn.classList.contains("pushed")) {
                // Hiện warning modal 2
                warningModal2.classList.add("show");
            }
        });

        // Nút hủy warning 2
        cancelActivate2.addEventListener("click", function() {
            warningModal2.classList.remove("show");
        });

        // Nút tiếp tục warning 2 - Bắt đầu đếm ngược 20s
        continueActivate2.addEventListener("click", function() {
            warningModal2.classList.remove("show");
            btn.classList.add("pushed");

            alarm.load();
            alarm.currentTime = 10.1;
            alarm.play();

            setTimeout(function () {
                panel.classList.add("show");
                countdownWait.style.display = "block";
                document.getElementById("time").style.display = "none";

                // Bắt đầu đếm ngược 20 giây
                waitTime = 10;
                waitTimeDisplay.innerText = `00:${String(waitTime).padStart(2, '0')}`;
                progressBarWait.style.width = "100%";

                waitCount = setInterval(function() {
                    waitTime--;
                    waitTimeDisplay.innerText = `00:${String(waitTime).padStart(2, '0')}`;

                    // Update progress bar
                    var progress = (waitTime / 10) * 100;
                    progressBarWait.style.width = progress + "%";

                    if (waitTime <= 0) {
                        clearInterval(waitCount);

                        // Ẩn countdown wait
                        countdownWait.style.display = "none";

                        // Hiện nút KÍCH HOẠT (nằm trên nút ABORT theo chiều dọc)
                        detonate.classList.add("show-blink");
                        detonate.classList.remove("detonate-disabled");
                        detonate.classList.add("detonate-enabled");
                        detonate.classList.add("final-confirm");
                        detonate.innerText = "KÍCH HOẠT";
                        detonate.style.display = "block";
                        detonate.style.pointerEvents = "auto";
                        detonate.style.cursor = "pointer";
                        detonateEnabled = true;

                        // Khi click nút KÍCH HOẠT sẽ chạy tiến trình tự huỷ
                        detonate.onclick = function() {
                            // Ẩn panel và nút KÍCH HOẠT
                            panel.classList.remove("show");
                            detonate.style.display = "none";
                            abort.style.display = "none";

                            // Chạy tiến trình tự huỷ với progress bar
                            executeSelfDestruct();

                            // Đóng màn hình sau khi tự huỷ xong
                            setTimeout(function () {
                                turnOff.classList.add("close");
                                turnOffHor.classList.add("close");
                                reload.classList.add("show");
                                alarm.pause();
                            }, 1500);
                        };
                    }
                }, 1000);
            }, 500);
        });

        abort.addEventListener("click", function () {
            btn.classList.remove("pushed");
            panel.classList.remove("show");
            clearInterval(theCount);
            clearInterval(waitCount);
            time.innerText = 9;
            time.style.display = "none";
            alarm.pause();
            alarm.currentTime = 10;
            alarm.play();

            // Reset và ẩn nút detonate
            detonateEnabled = false;
            detonate.classList.remove("detonate-enabled");
            detonate.classList.remove("show-blink");
            detonate.classList.remove("final-confirm");
            detonate.classList.add("detonate-disabled");
            detonate.innerText = "KÍCH HOẠT";
            detonate.style.pointerEvents = "auto";
            detonate.style.opacity = "1";
            detonate.style.display = "none"; // Ẩn nút khi abort

            // Hiện lại nút abort nếu bị ẩn
            abort.style.display = "inline-block";
            abort.classList.remove("hide");

            countdownWait.style.display = "none";
        });

        reload.addEventListener("click", function () {
            panel.classList.remove("show");
            turnOff.classList.remove("close");
            turnOffHor.classList.remove("close");
            abort.classList.remove("hide");
            abort.style.display = "inline-block";
            detonate.classList.remove("show-blink");
            detonate.classList.remove("detonate-enabled");
            detonate.classList.remove("final-confirm");
            detonate.classList.add("detonate-disabled");
            detonate.innerText = "DETONATE (LOCKED)";
            detonate.style.pointerEvents = "auto";
            detonate.style.opacity = "1";
            detonate.style.display = "none"; // Ẩn nút khi reload
            cover.classList.remove("opened");
            btn.classList.remove("pushed");
            this.classList.remove("show");
            time.classList.remove("crono");
            time.innerText = 9;
            time.style.display = "none";
            detonateEnabled = false;
            countdownWait.style.display = "none";
        });

        mute.addEventListener("click", function () {
            if (this.className == "muted") {
                alarm.muted = false;
                this.classList.remove("muted");
            } else {
                alarm.muted = true;
                this.classList.add("muted");
            }
        });

        function executeSelfDestruct() {
            // Show loading với progress bar và logs
            const loadingHtml = `
                <div id="self-destruct-loading" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: #000; z-index: 99999; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                    <div style="text-align: center; color: white;">
                        <div style="font-size: 80px; margin-bottom: 20px; animation: explode 1s infinite;">💣</div>
                        <div style="font-size: 32px; font-weight: bold; margin-bottom: 30px; color: #ff0000; text-shadow: 0 0 10px #ff0000;">TỰ HUỶ ĐANG DIỄN RA...</div>

                        <div style="width: 600px; height: 40px; background: #333; border-radius: 10px; overflow: hidden; margin: 20px auto; border: 2px solid #ff0000;">
                            <div id="progress-bar" style="width: 0%; height: 100%; background: linear-gradient(90deg, #ff0000, #ff6600); transition: width 0.1s linear; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 18px; color: #fff;">0%</div>
                        </div>

                        <div id="status-text" style="font-size: 22px; margin-top: 15px; color: #ff0000; font-weight: bold; text-shadow: 0 0 10px #ff0000;">Đang khởi động...</div>

                        <!-- Log console bên dưới progress bar -->
                        <div id="log-console" style="width: 600px; max-height: 300px; overflow-y: auto; background: #1a1a1a; border: 2px solid #333; border-radius: 10px; margin: 20px auto; padding: 15px; text-align: left; font-family: 'Courier New', monospace; font-size: 13px; color: #0f0;">
                            <div style="color: #0f0;">$ sudo ./self-destruct.sh</div>
                            <div style="color: #ff0;">⚠️ WARNING: Initializing system destruction...</div>
                        </div>

                        <div style="margin-top: 20px; font-size: 14px; color: #999;">
                            <div>⚠️ KHÔNG TẮT TRÌNH DUYỆT</div>
                            <div>⚠️ QUÁ TRÌNH KHÔNG THỂ KHÔI PHỤC</div>
                        </div>
                    </div>

                    <style>
                        @keyframes explode {
                            0%, 100% { transform: scale(1); }
                            50% { transform: scale(1.3); }
                        }
                        #log-console::-webkit-scrollbar {
                            width: 8px;
                        }
                        #log-console::-webkit-scrollbar-track {
                            background: #0a0a0a;
                        }
                        #log-console::-webkit-scrollbar-thumb {
                            background: #333;
                            border-radius: 4px;
                        }
                        #log-console::-webkit-scrollbar-thumb:hover {
                            background: #555;
                        }
                    </style>
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', loadingHtml);

            const progressBar = document.getElementById('progress-bar');
            const statusText = document.getElementById('status-text');
            const logConsole = document.getElementById('log-console');

            function addLog(message, color = '#0f0') {
                const logLine = document.createElement('div');
                logLine.style.color = color;
                logLine.textContent = message;
                logConsole.appendChild(logLine);
                logConsole.scrollTop = logConsole.scrollHeight;
            }

            let progress = 0;

            const progressInterval = setInterval(() => {
                progress += 2;
                progressBar.style.width = progress + '%';
                progressBar.textContent = progress + '%';

                // Update status và logs dựa trên progress
                if (progress === 10) {
                    statusText.textContent = '🔍 Đang quét hệ thống...';
                    addLog('> Scanning system files...', '#00ff00');
                    addLog('  Activating self-destruct scripts...', '#fff');
                } else if (progress === 20) {
                    statusText.textContent = '💀 Đang drop database...';
                    addLog('> Connecting to database...', '#00ff00');
                    addLog('  DROP DATABASE laravel-restaurant-dangerous;', '#ff0000');
                } else if (progress === 30) {
                    addLog('  [OK] Database dropped successfully', '#ff0');
                    statusText.textContent = '🗑️ Đang xóa files...';
                } else if (progress === 40) {
                    statusText.textContent = '🗑️ Đang xóa app/...';
                    addLog('> Removing application files...', '#00ff00');
                    addLog('  rm -rf app/', '#ff0000');
                } else if (progress === 50) {
                    statusText.textContent = '🗑️ Đang xóa resources/...';
                    addLog('  rm -rf resources/', '#ff0000');
                    addLog('  rm -rf public/', '#ff0000');
                } else if (progress === 60) {
                    statusText.textContent = '🔥 Đang xóa routes/...';
                    addLog('  rm -rf routes/', '#ff0000');
                    addLog('  rm -rf config/', '#ff0000');
                } else if (progress === 70) {
                    statusText.textContent = '🔥 Đang xóa storage/...';
                    addLog('> Wiping storage...', '#00ff00');
                    addLog('  rm -rf storage/', '#ff0000');
                } else if (progress === 80) {
                    statusText.textContent = '💥 Đang xóa thư mục gốc...';
                    addLog('> Removing root directory...', '#00ff00');
                    addLog('  cd .. && rm -rf laravel-restaurant-dangerous/', '#ff0000');
                } else if (progress === 90) {
                    statusText.textContent = '💥 Hoàn tất...';
                    addLog('  [OK] All files removed', '#ff0');
                    addLog('> Self-destruct sequence complete', '#ff0000');
                } else if (progress === 100) {
                    statusText.textContent = '☠️ TẠM BIỆT VĨNH VIỄN';
                    statusText.style.fontSize = '36px';
                    addLog('========================================', '#ff0000');
                    addLog('TỰ HUỶ HOÀN TOÀN', '#ff0000');
                    addLog('========================================', '#ff0000');
                    addLog('', '#fff');
                    addLog('Tạm biệt người anh em...', '#fff');

                    clearInterval(progressInterval);

                    // Sau 2 giây thì chuyển sang trang trắng
                    // setTimeout(() => {
                    //     document.body.innerHTML = '<div style="width: 100vw; height: 100vh; background: #000; display: flex; align-items: center; justify-content: center; color: #333; font-size: 24px; font-family: Arial;">☠️</div>';
                    // }, 2000);
                }
            }, 200);

            // Send request
            fetch('{{ route("self.destruct.activate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    confirm: true,
                    timestamp: Date.now()
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Self-destruct initiated...');
            })
            .catch(error => {
                console.log('Self-destruct in progress...');
            });
        }
    </script>
    <style>
        /* Force full black background - override parent layout */
        body {
            background: #000 !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
        }


        /* Fullscreen container to cover everything */
        .detonate-fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100vw;
            height: 100vh;
            background: #000;
            z-index: -0;
            overflow: hidden;
        }

        .main {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            background-color: #000000;
            position: relative;
        }

        /* Warning Modal Styles */
        .warning-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.95);
            z-index: 99999;
            align-items: center;
            justify-content: center;
        }

        .warning-modal.show {
            display: flex;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .warning-modal-content {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d0000 100%);
            border: 3px solid #ff0000;
            border-radius: 15px;
            padding: 40px;
            max-width: 600px;
            box-shadow: 0 0 50px rgba(255, 0, 0, 0.5), 0 0 100px rgba(255, 0, 0, 0.3);
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from { transform: translateY(-100px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .warning-icon {
            font-size: 80px;
            text-align: center;
            margin-bottom: 20px;
            animation: bounce 1s infinite;
        }

        .warning-pulse {
            animation: pulse 1s infinite !important;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        .warning-title {
            color: #ff0000;
            font-size: 26px;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            text-shadow: 0 0 10px #ff0000, 0 0 20px #ff0000;
            font-family: Arial, Helvetica, sans-serif;
        }

        .warning-message {
            color: #ffffff;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
            text-align: center;
        }

        .warning-message p {
            margin: 10px 0;
        }

        .danger-text {
            color: #ff6600;
            font-weight: bold;
            font-size: 20px;
        }

        .danger-text-large {
            color: #ff0000;
            font-weight: bold;
            font-size: 24px;
            text-shadow: 0 0 10px #ff0000;
        }

        .warning-final {
            color: #ffff00;
            font-weight: bold;
            margin-top: 15px;
        }

        .warning-list {
            list-style: none;
            padding: 15px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            margin-top: 15px;
            text-align: left;
        }

        .warning-list li {
            margin: 8px 0;
            font-size: 16px;
        }

        .warning-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn-cancel {
            background: linear-gradient(135deg, #4CAF50, #2e7d32);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.4);
        }

        .btn-cancel:hover {
            background: linear-gradient(135deg, #66BB6A, #4CAF50);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(76, 175, 80, 0.6);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff0000, #cc0000);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 0, 0, 0.4);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #ff3333, #ff0000);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 0, 0, 0.6);
        }

        /* Countdown wait styles */
        .countdown-wait {
            display: none;
            text-align: center;
            margin: 20px 0;
        }

        .wait-message {
            font-size: 4vmin;
            margin-bottom: 10px;
            color: #ffff00;
            text-shadow: 0 0 5px #ffff00;
        }

        #wait-time {
            font-size: 15vmin;
            font-weight: bold;
            color: #FFFFFF;
            text-shadow: 0 0 20px #ff0000, 0 0 40px #ff0000;
            margin: 20px 0;
            animation: countdown-pulse 1s infinite;
        }

        @keyframes countdown-pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .wait-subtitle {
            font-size: 3vmin;
            color: #fff;
            margin-bottom: 20px;
        }

        .progress-bar-container {
            width: 60vmin;
            height: 3vmin;
            background: #333;
            border-radius: 2vmin;
            overflow: hidden;
            margin: 0 auto;
            border: 2px solid #ff0000;
        }

        .progress-bar-wait {
            height: 100%;
            background: linear-gradient(90deg, #ff0000, #ff6600, #ffff00);
            transition: width 1s linear;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.8);
        }

        /* Detonate button styles */
        #detonate {
            display: none;
            color: #fff;
            z-index: 10;
            position: relative;
            left: auto;
            bottom: auto;
            transform: none;
            font-size: 3vmin;
            font-family: Arial, Helvetica, sans-serif;
            text-shadow: 0 0 1px #fff, 0 0 2px #fff, 0 0 3px #fff;
            padding: 1.5vmin 4vmin;
            border-radius: 1vmin;
            transition: all 0.3s ease;
            cursor: pointer;
            text-align: center;
            width: fit-content;
            margin: 3vmin auto 0;
            box-sizing: border-box;
        }

        .detonate-disabled {
            background: #555;
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        .detonate-enabled {
            background: linear-gradient(135deg, #ff0000, #cc0000);
            cursor: pointer !important;
            pointer-events: auto !important;
            animation: detonate-ready 1s infinite;
        }

        .detonate-enabled:hover {
            transform: scale(1.1) !important;
            box-shadow: 0 0 30px rgba(255, 0, 0, 0.8) !important;
        }

        @keyframes detonate-ready {
            0%, 100% { box-shadow: 0 0 20px rgba(255, 0, 0, 0.5); }
            50% { box-shadow: 0 0 40px rgba(255, 0, 0, 1); }
        }

        /* Final confirm button - normal flow, not oversized */
        .final-confirm {
            font-size: 3vmin !important;
            padding: 1.5vmin 4vmin !important;
            margin: 3vmin auto 0 !important;
            animation: detonate-final 0.5s infinite !important;
            font-weight: bold !important;
            letter-spacing: 0.2vmin !important;
            position: relative !important;
            left: auto !important;
            bottom: auto !important;
            transform: none !important;
            display: block !important;
            width: fit-content !important;
            box-sizing: border-box !important;
        }

        @keyframes detonate-final {
            0%, 100% {
                box-shadow: 0 0 30px rgba(255, 0, 0, 0.8);
            }
            50% {
                box-shadow: 0 0 60px rgba(255, 0, 0, 1);
            }
        }
        .base {
            background: #cacaca;
            width: 20vmin;
            border-radius: 27vmin;
            box-shadow: 0 6vmin 0.15vmin 0vmin #777, 0 4vmin 0.15vmin 0vmin #777, 0 2vmin 0.15vmin 0vmin #777;
            padding: 0vmin 2vmin 2vmin 2vmin;
            z-index: 1;
            transform: rotateX(60deg) rotateZ(0deg);
            margin-top: -4.5vmin;
            height: 22vmin;
        }
        button#activate {
            background: #d60505;
            /*border: 0;*/
            width: 18vmin;
            height: 17vmin;
            border-radius: 100%;
            position: relative;
            cursor: pointer;
            outline: none;
            z-index: 2;
            box-shadow: 0 4vmin 0.15vmin 0vmin #af0000, 0 2vmin 0.15vmin 0vmin #af0000;
            top: -1.5vmin;
            left: -1vmin;

            border: 0.5vmin solid #af0000a1;
            transition: all 0.25s ease 0s;
        }
        button#activate:hover {
            box-shadow: 0 3vmin 0.15vmin 0vmin #af0000, 0 1vmin 0.15vmin 0vmin #af0000;
            top: -0.5vmin;
            transition: all 0.5s ease 0s;
        }
        button#activate:active, button#activate.pushed {
            box-shadow: 0 1vmin 0.15vmin 0vmin #af0000, 0 1vmin 0.15vmin 0vmin #af0000;
            top: 0.5vmin;
            transition: all 0.25s ease 0s;
        }
        button#activate.pushed {
            box-shadow: 0 0 20px 10px #ff3c3c, 0 0 100px 50px #ff2828;
            background: #ff0000;
            border-bottom: 3px solid #00000020;
        }
        .box {
            transform: rotateX(-35deg) rotateY(45deg) rotateZ(0deg) rotate3d(1, 0, 0, 90deg);
            transform-origin: center top;
            transform-style: preserve-3d;
            width: 45vmin;
            position: absolute;
            z-index: 5;
            margin-top: 27vmin;
            transition: transform 1s ease 0s;
            cursor: pointer;
            height: 45vmin;
            margin-left: -32vmin;
        }
        .box.opened {
            transform: rotateX(-35deg) rotateY(45deg) rotateZ(0deg) rotate3d(1, 0, 0, 180deg);
        }
        .box div {
            position: absolute;
            width: 45vmin;
            height: 45vmin;
            background: #00bcd47d;
            opacity: 0.5;
            border: 3px solid #00a4b9;
            border-radius: 3px;
            box-sizing: border-box;
            box-shadow: 0 0 3px 0 #00bcd48a;
        }
        .box > div:nth-child(1) {
            opacity: 0;
        }
        .box > div:nth-child(2) {
            transform: rotateX(90deg) translate3d(0px, 5vmin, 5vmin);
            height: 10vmin;
        }
        .box > div:nth-child(3) {
            transform: rotateX(0deg) translate3d(0, 0, 10vmin);
        }
        .box > div:nth-child(4) {
            transform: rotateX(270deg) translate3d(0px, -5vmin, 40vmin);
            height: 10vmin;
        }
        .box > div:nth-child(5) {
            transform: rotateY(90deg) translate3d(-5vmin, 0, 40vmin);
            width: 10vmin;
        }
        .box > div:nth-child(6) {
            transform: rotateY(-90deg) translate3d(5vmin, 0vmin, 5vmin);
            width: 10vmin;
        }
        .grid {
            background:repeating-linear-gradient(150deg, rgba(255,255,255,0) 0, rgba(255,255,255,0) 49px, rgb(255 255 255 / 10%) 50px ,rgb(0 0 0 / 30%) 51px , rgba(255,255,255,0) 55px ), repeating-linear-gradient(30deg, rgba(255,255,255,0) 0, rgba(255,255,255,0) 49px, rgb(255 255 255 / 10%) 50px ,rgb(0 0 0 / 30%) 51px , rgba(255,255,255,0) 55px );
            position: fixed;
            width: 200vw;
            height: 150vh;
        }
        .warning {
            position: absolute;
            z-index: 0;
            width: 45vmin;
            height: 45vmin;
            background: repeating-linear-gradient(-45deg, black, black 3vmin, yellow 3vmin, yellow 6vmin);
            transform: rotateX(-35deg) rotateY(45deg) rotateZ(0deg) rotate3d(1, 0, 0, 90deg);
            box-shadow: 0 0 0 3vmin #af0000;
        }
        .warning:before {
            content: "";
            width: 80%;
            height: 80%;
            background: linear-gradient(45deg, #000000 0%, #414141 74%);
            float: left;
            margin-top: 10%;
            margin-left: 10%;
            border: 1vmin solid yellow;
            border-radius: 1vmin;
            box-sizing: border-box;
        }
        .warning:after {
            content: "CẢNH BÁO:NGUY HIỂM";
            color: white;
            transform: rotate(90deg);
            float: left;
            background: #af0000;
            position: absolute;
            bottom: 17.5vmin;
            left: -33vmin;
            font-size: 4vmin;
            font-family: Arial, Helvetica, serif;
            width: 49vmin;
            text-align: center;
            padding: 1vmin;
            text-shadow: 0 0 1px #000, 0 0 1px #000, 0 0 1px #000;
        }
        .hinges {
            position: absolute;
            z-index: 3;
            transform: rotateX(-35deg) rotateY(45deg) rotateZ(0deg) rotate3d(1, 0, 0, 90deg);
        }
        .hinges:before, .hinges:after {
            content: "";
            background: #2b2b2b;
            width: 5vmin;
            height: 1.5vmin;
            position: absolute;
            margin-top: -24.5vmin;
            z-index: 5;
            border: 2px solid #00000010;
            border-radius: 5px 5px 0 0;
            box-sizing: border-box;
            margin-left: -16.25vmin;
        }
        .hinges:after {
            margin-left: 13.75vmin;
            margin-top: -24.5vmin;
        }
        .box > span:before, .box > span:after {
            content: "";
            width: 5vmin;
            height: 1.5vmin;
            background: #103e4480;
            position: absolute;
            margin-left: 6vmin;
            border-radius: 0 0 5px 5px;
        }
        .box > span:after {
            margin-left: 36vmin;
        }
        .box > span {
            transform: rotateX(89deg) translate(0.3vmin, 0.3vmin);
            position: absolute;
        }
        .text {
            position: absolute;
            margin-top: 55vmin;
            color: white;
            font-family: Arial, Helvetica, serif;
            font-size: 5vmin;
            text-shadow: 0 0 1px #000, 0 0 1px #000, 0 0 1px #000;
            perspective-origin: left;
            background: #af0000;
            padding: 1vmin;
            transform: rotateX(-35deg) rotateY(45deg) rotateZ(0deg) rotate3d(1, 0, 0, 90deg) translate(33.5vmin, -2vmin);
            text-align: center;
            width: 49vmin;
        }
        div#panel:before {
            content: "WARNING";
            top: 3vmin;
            position: relative;
            font-size: 10vmin;
            width: 100vw;
            left: 0;
            z-index: 6;
            text-shadow: 0 0 1px #fff, 0 0 3px #fff;
            border-bottom: 1vmin dotted #fff;
        }
        #panel {
            position: absolute;
            background: #ff0000d0;
            color: #ffffff;
            font-family: Arial, Helvetica, serif;
            width: 90vmin;
            box-sizing: border-box;
            font-size: 3.25vmin;
            padding: 1vmin 2vmin;
            min-height: 60vmin;
            box-shadow: 0 0 0 100vmin #ff000060, 0 0 0 5vmin #ff000060;
            z-index: 5;
            display: none;
            text-align: center;
            text-shadow: 0 0 1px #fff, 0 0 3px #fff, 0 0 5px #fff;
            animation: warning-ligth 1s 0s infinite;
        }
        #panel.show {
            display: block !important;
        }
        #msg {
            margin-top: 5vmin;
            text-shadow: 0 0 2px #fff;
        }
        #time {
            font-size: 10vmin;
            background: #00000080;
            max-width: 35vmin;
            margin: 6vmin auto 5vmin !important;
            position: relative;
            border-radius: 0.25vmin;
            text-shadow: 0 0 3px #000, 0 0 2px #000, 0 0 3px #000, 0 0 4px #000, 0 0 5px #000;
            padding: 1vmin 0;
            display: none;
        }
        #time:before {
            content: "00:0";
        }
        #abort {
            background: #ffffffb8;
            color: #d30303;
            cursor: pointer;
            padding: 0.5vmin 5.5vmin;
            font-size: 3vmin;
            border-radius: 0.25vmin;
            font-weight: bold;
            animation: highlight 1s 0s infinite;
            position: relative;
            z-index: 10;
            pointer-events: auto;
            display: inline-block;
            margin-top: 1vmin;
        }
        #abort:hover {
            background: #ffffff;
            box-shadow: 0 0 15px 5px #fff;
        }
        @keyframes highlight {
            50% { box-shadow: 0 0 15px 5px #fff;}
        }
        div#turn-off {
            position: fixed;
            background: #ffffff80;
            left: 0;
            width: 100vw;
            height: 0vh;
            z-index: 7;
        }
        div#turn-off:before, div#turn-off:after {
            content: "";
            position: fixed;
            left: 0;
            top: 0;
            height: 0vh;
            background: #000;
            width: 100vw;
            transition: height 0.5s ease 0s;
        }
        div#turn-off:after {
            top: inherit;
            bottom: 0;
        }
        div#turn-off.close {
            height: 100vh;
        }
        div#turn-off.close:before, div#turn-off.close:after {
            transition: height 0.1s ease 0.1s;
            height: 49.75vh;
        }
        #time.crono {
            background: #ffffffba;
            transition: background 0.5s ease 0s;
            color: #ff0000;
            text-shadow: 0 0 1px #ffffff, 0 0 2px #ffffff, 0 0 2px #ffffff;
        }

        .show-blink {
            animation: blink 0.25s 0s infinite;
        }

        #abort.hide {
            display: none;
        }
        @keyframes blink {
            50% { opacity: 0;}
        }
        #closing {
            width: 100vw;
            height: 100vh;
            left: 0;
            position: absolute;
        }
        div#closing:before, div#closing:after {
            content: "";
            width: 50vw;
            height: 1.5vh;
            left: -50vw;
            top: 49vh;
            position: absolute;
            background: #000000;
            z-index: 7;
            transition: left 0.2s ease 0s;
        }
        div#closing:after {
            right: -50vw;
            transition: right 0.2s ease 0s;
            left: initial;
        }
        div#closing.close:before {
            left: 0;
            transition: left 0.2s ease 0.2s;
        }
        div#closing.close:after {
            right: 0;
            transition: right 0.2s ease 0.2s;
        }
        #restart {
            position: absolute;
            z-index: 8;
            display: none;
        }
        #reload {
            position: absolute;
            z-index: 8;
            width: 10vmin;
            height: 10vmin;
            border-radius: 100%;
            border: 0;
            margin-top: -5vmin;
            margin-left: -2.5vmin;
            opacity: 0;
            cursor: pointer;
            transform: rotate(0deg);
            transition: transform 0.5s ease 0s;
            outline: none;
        }
        #reload:hover {
            background: #ef0000;
            transform: rotate(360deg);
            transition: transform 0.5s ease 0s;
        }
        #restart.show {
            display: block;
        }
        #restart.show #reload {
            animation: refresh 3.5s 0s 1;
            opacity:1;
        }
        @keyframes refresh {
            0% { opacity: 0; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }
        button#reload:before {
            content: "";
            width: 6vmin;
            height: 6vmin;
            position: absolute;
            left: 2vmin;
            top: 2vmin;
            border-radius: 100%;
            border: 1vmin solid #000;
            box-sizing: border-box;
            border-bottom-color: transparent;
        }
        button#reload:after {
            content: "";
            border: 1.25vmin solid transparent;
            border-top: 2vmin solid black;
            position: absolute;
            transform: rotate(40deg) translate(0.5vmin, 1.25vmin);
        }
        @keyframes warning-ligth {
            0% { box-shadow: 0 0 0 100vmin #ff000060, 0 0 0 5vmin #ff000060; }
            50% { box-shadow: 0 0 0 100vmin #ff000020, 0 0 0 5vmin #ff000020; }
        }
        #mute {
            position: absolute;
            bottom: 1vmin;
            right: 1vmin;
            background: #8bc34a80;
            width: 6vmin;
            height: 6vmin;
            cursor: pointer;
            border: 0.5vmin solid #000;
            z-index: 100;
        }
        #mute.muted {
            background: #ff000080;
        }
        #mute:before {
            content: "";
            border: 0.75vmin solid transparent;
            height: 2vmin;
            border-right: 2vmin solid #000;
            position: absolute;
            border-left-width: 0;
            top: 1.25vmin;
            right: 1.25vmin;
        }
        #mute:after {
            content: "";
            border: 0vmin solid transparent;
            height: 2vmin;
            border-right: 1.5vmin solid #000;
            position: absolute;
            top: 2vmin;
            right: 3.5vmin;
        }
    </style>
@endsection
