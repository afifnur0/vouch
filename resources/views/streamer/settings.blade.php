<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Fitur - VOUCH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #05060f;
            --bg-panel: rgba(255, 255, 255, 0.03);
            --accent-lime: #ccff00;
            --accent-purple: #9945ff;
            --accent-red: #ff3366;
            --text-main: #ffffff;
            --text-muted: #8b92a5;
            --border: rgba(255, 255, 255, 0.1);
            --input-bg: rgba(0, 0, 0, 0.3);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Background Effects */
        .bg-glow {
            position: fixed;
            top: -50%; left: 50%;
            width: 100vw; height: 100vh;
            background: radial-gradient(circle, rgba(204, 255, 0, 0.06), transparent 60%);
            transform: translateX(-50%);
            z-index: -1;
            pointer-events: none;
        }

        .grid-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: -2;
            pointer-events: none;
        }

        .navbar {
            display: flex; justify-content: space-between; align-items: center;
            padding: 24px 48px;
            z-index: 10;
            position: sticky; top: 0;
            background: rgba(5, 6, 15, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
            animation: slideDown 0.6s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo { font-size: 24px; font-weight: 900; color: var(--accent-lime); letter-spacing: -1px; text-decoration: none; }

        .nav-link {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.2s;
            border: 1px solid transparent;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--border);
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 40px;
            animation: slideUp 0.6s ease 0.1s both;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Sidebar Tabs */
        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 12px;
            position: sticky;
            top: 120px;
        }

        .menu-btn {
            background: rgba(10, 12, 20, 0.5);
            border: 1px solid var(--border);
            color: var(--text-muted);
            text-align: left;
            padding: 16px 20px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .menu-btn::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: var(--accent-lime);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .menu-btn:hover {
            background: rgba(10, 12, 20, 0.8);
            color: #fff;
            transform: translateX(4px);
        }

        .menu-btn.active {
            background: rgba(204, 255, 0, 0.1);
            color: var(--accent-lime);
            border: 1px solid rgba(204, 255, 0, 0.3);
            transform: translateX(4px);
        }

        .menu-btn.active::before {
            transform: scaleY(1);
        }

        .menu-icon {
            margin-right: 12px;
            width: 16px;
            text-align: center;
            display: inline-block;
        }

        /* Content Area */
        .settings-panel {
            background: rgba(10, 12, 20, 0.5);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 40px;
            backdrop-filter: blur(20px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.6s ease 0.2s both;
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.4s ease;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .panel-title {
            font-size: 24px;
            font-weight: 900;
            margin-bottom: 12px;
            background: linear-gradient(135deg, #ccff00, #ffffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .panel-desc {
            color: var(--text-muted);
            font-size: 16px;
            margin-bottom: 32px;
            line-height: 1.6;
        }

        /* Success Message */
        .success-message {
            background: rgba(204, 255, 0, 0.1);
            border: 1px solid var(--accent-lime);
            color: var(--accent-lime);
            padding: 16px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideDown 0.4s ease;
        }

        .success-message::before {
            content: '✅';
            font-size: 18px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 28px;
            animation: slideUp 0.6s ease;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: var(--text-muted);
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-control {
            width: 100%;
            background: var(--input-bg);
            border: 1px solid var(--border);
            color: var(--text-main);
            padding: 14px 16px;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .form-control::placeholder {
            color: rgba(139, 146, 165, 0.6);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-lime);
            background: rgba(0, 0, 0, 0.5);
            box-shadow: 0 0 20px rgba(204, 255, 0, 0.2);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .form-note {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 8px;
            font-style: italic;
        }

        /* Toggle Switch */
        .toggle-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(0, 0, 0, 0.3);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .toggle-container:hover {
            border-color: rgba(204, 255, 0, 0.3);
            background: rgba(0, 0, 0, 0.5);
        }

        .toggle-info {
            flex: 1;
        }

        .toggle-title {
            font-weight: 600;
            color: #fff;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .toggle-desc {
            font-size: 12px;
            color: var(--text-muted);
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 52px;
            height: 28px;
            margin-left: 16px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #333;
            transition: .4s;
            border-radius: 28px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background: linear-gradient(135deg, var(--accent-lime), #a8d400);
        }

        input:checked + .slider:before {
            transform: translateX(24px);
            background-color: #000;
        }

        .btn-save {
            background: linear-gradient(135deg, var(--accent-lime), #a8d400);
            color: #000;
            border: none;
            padding: 16px 32px;
            font-weight: 800;
            border-radius: 12px;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(204, 255, 0, 0.2);
            float: right;
            animation: slideUp 0.6s ease 0.5s both;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(204, 255, 0, 0.3);
        }

        .btn-save:active {
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .container {
                grid-template-columns: 1fr;
                gap: 32px;
            }
            .sidebar-menu {
                position: static;
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 12px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 20px 24px;
                flex-direction: column;
                gap: 16px;
            }
            .container {
                margin: 20px auto;
            }
            .settings-panel {
                padding: 24px;
            }
            .panel-title {
                font-size: 20px;
            }
            .sidebar-menu {
                grid-template-columns: 1fr;
            }
            .menu-btn {
                padding: 12px 16px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="bg-glow"></div>
    <div class="grid-overlay"></div>

    <nav class="navbar">
        <a href="/dashboard" class="logo">✦ VOUCH</a>
        <a href="/dashboard" class="nav-link">&larr; Kembali ke Dashboard</a>
    </nav>

    <div class="container">
        <div class="sidebar-menu">
            <button class="menu-btn active" onclick="openTab(event, 'tab-overlay')">
                <span class="menu-icon">🎬</span> Overlay & Notifikasi
            </button>
            <button class="menu-btn" onclick="openTab(event, 'tab-public')">
                <span class="menu-icon">🌐</span> Halaman Donasi
            </button>
            <button class="menu-btn" onclick="openTab(event, 'tab-media')">
                <span class="menu-icon">🎵</span> Media Share
            </button>
            <button class="menu-btn" onclick="openTab(event, 'tab-milestone')">
                <span class="menu-icon">🎯</span> Target Milestone
            </button>
            <button class="menu-btn" onclick="openTab(event, 'tab-filter')">
                <span class="menu-icon">🛡️</span> Filter Kata (Mod)
            </button>
        </div>

        <div class="settings-panel">

            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <form action="/dashboard/settings" method="POST">
                @csrf

                <div id="tab-overlay" class="tab-content active">
                    <h2 class="panel-title">Pengaturan Overlay OBS</h2>
                    <p class="panel-desc">Atur visual dan suara yang muncul saat ada donasi masuk.</p>

                    <div class="form-group">
                        <label class="form-label">🎨 Gambar/GIF Animasi (URL)</label>
                        <input type="text" class="form-control" name="alert_image_url" value="{{ $settings->alert_image_url ?? '' }}" placeholder="https://imgur.com/contoh.gif">
                        <div class="form-note">*URL gambar yang akan muncul saat donasi masuk</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">🔊 Sound Effect Alert (URL MP3)</label>
                        <input type="text" class="form-control" name="alert_sound_url" value="{{ $settings->alert_sound_url ?? '' }}" placeholder="https://contoh.com/suara.mp3">
                        <div class="form-note">*File suara yang akan dimainkan saat donasi</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">💬 Minimum Donasi untuk Text-to-Speech (Rp)</label>
                        <input type="number" class="form-control" name="tts_minimum_amount" value="{{ $settings->tts_minimum_amount ?? '10000' }}">
                        <div class="form-note">*Donasi di bawah nominal ini tidak akan dibacakan</div>
                    </div>
                </div>

                <div id="tab-public" class="tab-content">
                    <h2 class="panel-title">Halaman Donasi Publik</h2>
                    <p class="panel-desc">Kustomisasi tampilan profil vouch.tv/namakamu untuk penonton.</p>

                    <div class="form-group">
                        <label class="form-label">📝 Pesan Sambutan (Bio)</label>
                        <textarea class="form-control" name="page_bio" placeholder="Terima kasih sudah mendukung streaming saya!">{{ $settings->page_bio ?? '' }}</textarea>
                        <div class="form-note">*Pesan yang muncul di halaman donasi publik Anda</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">💰 Nominal Preset Cepat (Pisahkan dengan koma)</label>
                        <input type="text" class="form-control" name="preset_amounts"
                               value="{{ isset($settings->preset_amounts) ? implode(', ', $settings->preset_amounts) : '10000, 25000, 50000, 100000' }}">
                        <div class="form-note">*Tombol instan yang akan muncul di halaman donasi</div>
                    </div>
                </div>

                <div id="tab-media" class="tab-content">
                    <h2 class="panel-title">Media Share (Song Request)</h2>
                    <p class="panel-desc">Izinkan penonton memutar video YouTube di stream Anda.</p>

                    <div class="form-group">
                        <div class="toggle-container">
                            <div class="toggle-info">
                                <div class="toggle-title">🎵 Aktifkan Media Share</div>
                                <div class="toggle-desc">Penonton bisa mengirim link YouTube untuk dimainkan.</div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="is_media_share_enabled" {{ ($settings->is_media_share_enabled ?? false) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">💰 Minimum Donasi Media Share (Rp)</label>
                        <input type="number" class="form-control" name="media_share_minimum_amount" value="{{ $settings->media_share_minimum_amount ?? '50000' }}">
                        <div class="form-note">*Minimal donasi untuk bisa request lagu</div>
                    </div>
                </div>

                <div id="tab-milestone" class="tab-content">
                    <h2 class="panel-title">Target Milestone</h2>
                    <p class="panel-desc">Buat bar progres donasi untuk tujuan tertentu.</p>

                    <div class="form-group">
                        <div class="toggle-container">
                            <div class="toggle-info">
                                <div class="toggle-title">📊 Tampilkan Bar Target di Halaman Publik</div>
                                <div class="toggle-desc">Tampilkan progress donasi menuju target tertentu.</div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="is_milestone_enabled" {{ ($settings->is_milestone_enabled ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">🎯 Judul Target</label>
                        <input type="text" class="form-control" name="milestone_title" value="{{ $settings->milestone_title ?? '' }}" placeholder="Contoh: Upgrade PC / Modal Nikah">
                        <div class="form-note">*Judul target yang akan ditampilkan</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">💎 Nominal Target Keseluruhan (Rp)</label>
                        <input type="number" class="form-control" name="milestone_target_amount" value="{{ $settings->milestone_target_amount ?? '' }}" placeholder="10000000">
                        <div class="form-note">*Total target donasi yang ingin dicapai</div>
                    </div>
                </div>

                <div id="tab-filter" class="tab-content">
                    <h2 class="panel-title">Filter Moderasi</h2>
                    <p class="panel-desc">Cegah kata-kata tidak pantas dibaca oleh bot TTS.</p>

                    <div class="form-group">
                        <div class="toggle-container">
                            <div class="toggle-info">
                                <div class="toggle-title">🛡️ Aktifkan Filter Kasar Bawaan Sistem</div>
                                <div class="toggle-desc">Filter otomatis kata-kata tidak pantas.</div>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="is_default_filter_enabled" {{ ($settings->is_default_filter_enabled ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">🚫 Daftar Kata Terlarang Khusus (Pisahkan dengan koma)</label>
                        <textarea class="form-control" name="custom_banned_words" placeholder="kata1, kata2, kata3...">{{ isset($settings->custom_banned_words) ? implode(', ', $settings->custom_banned_words) : '' }}</textarea>
                        <div class="form-note" style="color: var(--accent-red);">*Pesan donasi yang mengandung kata-kata ini akan otomatis ditolak atau di-mute.</div>
                    </div>
                </div>

                <div style="clear: both; margin-top: 40px;"></div>
                <button type="submit" class="btn-save">💾 Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <script>
        function openTab(evt, tabId) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.remove("active");
            }
            tablinks = document.getElementsByClassName("menu-btn");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            document.getElementById(tabId).classList.add("active");
            evt.currentTarget.classList.add("active");
        }
    </script>
</body>
</html>