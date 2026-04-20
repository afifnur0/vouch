<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Streamer Dashboard - VOUCH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #05060f;
            --bg-panel: rgba(255, 255, 255, 0.03);
            --accent-lime: #ccff00;
            --accent-purple: #9945ff;
            --accent-red: #ff3366;
            --accent-yellow: #ffcc00;
            --text-main: #ffffff;
            --text-muted: #8b92a5;
            --border: rgba(255, 255, 255, 0.1);
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

        .logo { font-size: 24px; font-weight: 900; color: var(--accent-lime); letter-spacing: -1px; }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--accent-lime), var(--accent-purple));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #000;
        }

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

        .btn-logout {
            background: rgba(255, 51, 102, 0.1);
            color: var(--accent-red);
            border: 1px solid var(--accent-red);
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
        }

        .btn-logout:hover {
            background: var(--accent-red);
            color: #fff;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
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

        /* Alert Onboarding */
        .alert-setup {
            background: linear-gradient(135deg, rgba(255, 204, 0, 0.1), rgba(255, 204, 0, 0.05));
            border: 1px solid rgba(255, 204, 0, 0.3);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(10px);
            animation: slideUp 0.6s ease 0.2s both;
        }

        .alert-icon {
            font-size: 32px;
            margin-right: 16px;
        }

        .alert-text h2 {
            color: var(--accent-yellow);
            font-size: 18px;
            margin-bottom: 8px;
            font-weight: 800;
        }

        .alert-text p {
            color: var(--text-muted);
            font-size: 14px;
            line-height: 1.5;
        }

        .btn-setup {
            background: linear-gradient(135deg, var(--accent-yellow), #e6b800);
            color: #000;
            text-decoration: none;
            padding: 12px 24px;
            font-weight: 800;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(255, 204, 0, 0.2);
        }

        .btn-setup:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(255, 204, 0, 0.3);
        }

        /* Layout Grids */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .links-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 40px;
        }

        .main-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 32px;
        }

        .left-col {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        /* Panels & Cards */
        .panel {
            background: rgba(10, 12, 20, 0.5);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 32px;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(20px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.6s ease;
        }

        .panel:nth-child(1) { animation-delay: 0.3s; }
        .panel:nth-child(2) { animation-delay: 0.4s; }
        .panel:nth-child(3) { animation-delay: 0.5s; }

        .panel-header {
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin-bottom: 24px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 12px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .panel-header::before {
            content: '';
            width: 4px;
            height: 16px;
            background: var(--accent-lime);
            border-radius: 2px;
        }

        /* Stat Cards */
        .stat-card {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--accent-lime);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(204, 255, 0, 0.3);
            box-shadow: 0 15px 40px rgba(204, 255, 0, 0.1);
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .stat-value {
            font-size: 40px;
            font-weight: 900;
            color: #fff;
            margin-bottom: 16px;
        }

        .stat-value.lime {
            background: linear-gradient(135deg, var(--accent-lime), #a8d400);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-action {
            background: linear-gradient(135deg, var(--accent-lime), #a8d400);
            color: #000;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(204, 255, 0, 0.2);
        }

        .stat-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(204, 255, 0, 0.3);
        }

        /* Quick Links */
        .link-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .link-box:hover {
            border-color: rgba(204, 255, 0, 0.3);
            background: rgba(0, 0, 0, 0.5);
        }

        .link-info h4 {
            font-size: 16px;
            margin-bottom: 6px;
            color: var(--accent-lime);
            font-weight: 700;
        }

        .link-info p {
            font-size: 13px;
            color: var(--text-muted);
            font-family: 'Courier New', monospace;
            word-break: break-all;
        }

        .btn-copy {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border: 1px solid var(--border);
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-copy:hover {
            background: #fff;
            color: #000;
        }

        .btn-copy.obs {
            background: var(--accent-lime);
            color: #000;
            border: none;
        }

        .btn-copy.obs:hover {
            background: #a8d400;
        }

        /* Lock Overlay */
        .locked-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(5, 6, 15, 0.9);
            backdrop-filter: blur(4px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 10;
            border-radius: 20px;
        }

        .locked-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .locked-text {
            background: rgba(0, 0, 0, 0.8);
            padding: 12px 20px;
            border-radius: 20px;
            border: 1px solid var(--border);
            font-size: 12px;
            font-weight: 800;
            color: var(--accent-red);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
            border: 1px dashed var(--border);
            border-radius: 16px;
            font-size: 16px;
            line-height: 1.6;
        }

        .empty-icon {
            font-size: 48px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-action {
            background: rgba(204, 255, 0, 0.1);
            color: var(--accent-lime);
            border: 1px dashed var(--accent-lime);
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            margin-top: 16px;
            transition: all 0.2s;
        }

        .empty-action:hover {
            background: var(--accent-lime);
            color: #000;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .main-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 20px 24px;
                flex-direction: column;
                gap: 16px;
            }
            .nav-right {
                width: 100%;
                justify-content: space-between;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .links-grid {
                grid-template-columns: 1fr;
            }
            .alert-setup {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
            .panel {
                padding: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="bg-glow"></div>
    <div class="grid-overlay"></div>

    <nav class="navbar">
        <div class="logo">✦ VOUCH</div>
        <div class="nav-right">
            <div class="user-info">
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <span>{{ auth()->user()->name }}</span>
            </div>

            <a href="/dashboard/settings" class="nav-link">
                <i class="bi bi-gear"></i> Pengaturan
            </a>

            <form action="/logout" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="container">

        @if(!$isOnboarded)
        <div class="alert-setup">
            <div style="display: flex; align-items: center;">
                <span class="alert-icon">⚠️</span>
                <div class="alert-text">
                    <h2>Aksi Diperlukan: Akun Belum Terverifikasi</h2>
                    <p>Anda belum bisa menerima dana atau membuat link donasi. Selesaikan verifikasi KYC dan pengaturan penarikan dana.</p>
                </div>
            </div>
            <a href="/dashboard/setup" class="btn-setup">Lengkapi Profil Sekarang</a>
        </div>
        @endif

        <div class="stats-grid">
            <div class="stat-card" style="position: relative; overflow: hidden;">
                @if(!$isOnboarded)
                    <div class="locked-overlay">
                        <div class="locked-icon">🔒</div>
                        <div class="locked-text">TERKUNCI</div>
                    </div>
                @endif
                <div class="stat-label">💰 Saldo Tersedia (Bisa Ditarik)</div>
                <div class="stat-value lime">Rp {{ number_format($availableBalance, 0, ',', '.') }}</div>
                <button class="stat-action">Cairkan Dana</button>
            </div>

            <div class="stat-card" style="position: relative; overflow: hidden;">
                @if(!$isOnboarded)
                    <div class="locked-overlay">
                        <div class="locked-icon">🔒</div>
                        <div class="locked-text">TERKUNCI</div>
                    </div>
                @endif
                <div class="stat-label">⏳ Dana Escrow (Tertahan)</div>
                <div class="stat-value">Rp {{ number_format($escrowTotal, 0, ',', '.') }}</div>
                <div style="font-size: 11px; color: var(--text-muted); margin-top: 12px;">
                    *Selesaikan tantangan bounty untuk mencairkan.
                </div>
            </div>
        </div>

        <div class="links-grid">
            <div class="panel" style="padding: 20px;">
                @if(!$isOnboarded)
                    <div class="locked-overlay">
                        <div class="locked-icon">🔒</div>
                        <div class="locked-text">TERKUNCI</div>
                    </div>
                @endif
                <div class="link-box">
                    <div class="link-info">
                        <h4>🔗 Public Donation Link</h4>
                        <p>{{ $publicLink }}</p>
                    </div>
                    <button class="btn-copy" onclick="navigator.clipboard.writeText('{{ $publicLink }}'); alert('Link disalin!')">Copy</button>
                </div>
            </div>

            <div class="panel" style="padding: 20px;">
                @if(!$isOnboarded)
                    <div class="locked-overlay">
                        <div class="locked-icon">🔒</div>
                        <div class="locked-text">TERKUNCI</div>
                    </div>
                @endif
                <div class="link-box">
                    <div class="link-info">
                        <h4 style="color: #fff;">🎬 OBS / Streamlabs Overlay URL</h4>
                        <p>Klik copy untuk menyalin token rahasia.</p>
                    </div>
                    <button class="btn-copy obs" onclick="navigator.clipboard.writeText('{{ $obsLink }}'); alert('URL Overlay disalin! Jangan berikan ke siapapun.')">Copy URL</button>
                </div>
            </div>
        </div>

        <div class="main-grid">
            <div class="left-col">
                <div class="panel">
                    @if(!$isOnboarded)
                        <div class="locked-overlay">
                            <div class="locked-icon">🔒</div>
                            <div class="locked-text">FITUR TERKUNCI</div>
                        </div>
                    @endif
                    <div class="panel-header">📊 Riwayat Transaksi & Donasi Terbaru</div>

                    @forelse($recentActivities as $activity)
                        @empty
                        <div class="empty-state">
                            <div class="empty-icon">📭</div>
                            Belum ada riwayat donasi atau transaksi masuk.
                        </div>
                    @endforelse
                </div>

                <div class="panel">
                    @if(!$isOnboarded)
                        <div class="locked-overlay">
                            <div class="locked-icon">🔒</div>
                            <div class="locked-text">FITUR TERKUNCI</div>
                        </div>
                    @endif
                    <div class="panel-header">🎯 Tantangan Aktif (Escrow)</div>

                    @forelse($activeBounties as $bounty)
                        @empty
                        <div class="empty-state">
                            <div class="empty-icon">🎯</div>
                            Belum ada tantangan aktif yang masuk.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="panel" style="align-self: start;">
                @if(!$isOnboarded)
                    <div class="locked-overlay">
                        <div class="locked-icon">🔒</div>
                        <div class="locked-text">FITUR TERKUNCI</div>
                    </div>
                @endif
                <div class="panel-header">👥 Squad Management (Auto-Split)</div>

                @forelse($mySquads as $squad)
                    @empty
                    <div class="empty-state">
                        <div class="empty-icon">👥</div>
                        Anda belum tergabung dalam Squad apapun.<br><br>
                        <button class="empty-action">+ Buat Squad Baru</button>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</body>
</html>