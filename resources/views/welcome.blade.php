<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOUCH // Beyond Donation</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #05060f;
            --bg-panel: rgba(255, 255, 255, 0.03);
            --accent-lime: #ccff00;
            --accent-purple: #9945ff;
            --accent-pink: #ff006e;
            --text-main: #ffffff;
            --text-muted: #8b92a5;
            --border: rgba(255, 255, 255, 0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* Animated Background Elements */
        .ambient-glow {
            position: fixed;
            top: 0; left: 50%;
            transform: translateX(-50%);
            width: 80vw; height: 80vh;
            background: radial-gradient(ellipse at top, rgba(204, 255, 0, 0.1), transparent 60%);
            z-index: -1;
            pointer-events: none;
        }

        .grid-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 40px 40px; z-index: -2;
            mask-image: linear-gradient(to bottom, black 40%, transparent 100%);
            -webkit-mask-image: linear-gradient(to bottom, black 40%, transparent 100%);
        }

        /* Navbar */
        .navbar {
            display: flex; justify-content: space-between; align-items: center;
            padding: 24px 48px;
            z-index: 10;
            position: sticky; top: 0;
            background: rgba(5, 6, 15, 0.7);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
        }
        .logo { font-size: 24px; font-weight: 900; color: var(--accent-lime); text-decoration: none; letter-spacing: -1px; }
        .nav-links { display: flex; gap: 30px; }
        .nav-link { color: #fff; text-decoration: none; font-size: 14px; font-weight: 600; transition: color 0.2s; }
        .nav-link:hover { color: var(--accent-lime); }

        /* Hero Section */
        .hero {
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            text-align: center; padding: 80px 20px 100px;
            animation: fadeIn 0.8s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .badge {
            background: rgba(204, 255, 0, 0.1);
            border: 1px solid rgba(204, 255, 0, 0.3);
            padding: 8px 18px; border-radius: 24px;
            font-size: 12px; font-weight: 700; letter-spacing: 1px;
            color: var(--accent-lime); margin-bottom: 24px;
            animation: slideDown 0.6s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero h1 {
            font-size: 64px; font-weight: 900; line-height: 1.1; margin-bottom: 20px;
            background: linear-gradient(135deg, #ccff00, #ffffff, #9945ff);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
            text-transform: uppercase; letter-spacing: -2px;
            animation: slideDown 0.8s ease 0.1s both;
        }
        
        .hero p {
            color: var(--text-muted); font-size: 18px; max-width: 700px;
            line-height: 1.8; margin-bottom: 60px;
            animation: slideDown 0.8s ease 0.2s both;
        }

        /* Cards Layout */
        .cards-wrapper {
            display: flex; gap: 32px; max-width: 1000px; width: 100%;
            flex-wrap: wrap; justify-content: center; margin-bottom: 100px;
            animation: slideDown 0.8s ease 0.3s both;
        }

        .card {
            flex: 1; min-width: 320px;
            background: rgba(10, 12, 20, 0.5);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            border-radius: 24px; padding: 50px 40px;
            text-align: left;
            transition: all 0.3s ease;
            position: relative; overflow: hidden;
        }

        .card::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 4px;
            background: var(--text-muted); opacity: 0.2; transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            border-color: rgba(204, 255, 0, 0.5);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4), 0 0 50px rgba(204, 255, 0, 0.08);
        }

        .card.streamer:hover::before { background: var(--accent-lime); opacity: 1; }
        .card.supporter:hover::before { background: var(--accent-purple); opacity: 1; }

        .card-icon {
            font-size: 40px; margin-bottom: 20px; display: inline-block;
        }

        .card h2 { font-size: 26px; font-weight: 800; margin-bottom: 16px; }
        .card p { color: var(--text-muted); font-size: 15px; line-height: 1.6; margin-bottom: 40px; }

        /* Buttons */
        .btn {
            display: block; width: 100%; text-align: center;
            padding: 14px; font-size: 14px; font-weight: 700;
            border-radius: 10px; text-decoration: none; text-transform: uppercase;
            transition: all 0.3s ease; border: none; cursor: pointer;
            letter-spacing: 0.5px;
        }
        .btn-lime { 
            background: linear-gradient(135deg, var(--accent-lime), #a8d400);
            color: #000; 
        }
        .btn-lime:hover { 
            box-shadow: 0 10px 30px rgba(204, 255, 0, 0.3);
            transform: scale(1.02);
        }
        
        .btn-purple { 
            background: linear-gradient(135deg, var(--accent-purple), #7b2cbf);
            color: #fff;
        }
        .btn-purple:hover { 
            box-shadow: 0 10px 30px rgba(153, 69, 255, 0.3);
            transform: scale(1.02);
        }

        .login-hint {
            display: block; text-align: center; margin-top: 18px;
            font-size: 13px; color: var(--text-muted); text-decoration: none;
        }
        .login-hint span { color: #fff; font-weight: 600; }
        .login-hint:hover span { color: var(--accent-lime); }

        /* Features Section */
        .section {
            padding: 100px 48px;
            max-width: 1200px; margin: 0 auto; width: 100%;
        }

        .section-title {
            font-size: 48px; font-weight: 900; text-align: center;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #ccff00, #ffffff);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            text-align: center; color: var(--text-muted);
            font-size: 16px; margin-bottom: 80px; max-width: 600px; margin-left: auto; margin-right: auto;
        }

        .features-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;
        }

        .feature-card {
            background: rgba(10, 12, 20, 0.4);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 40px;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            border-color: rgba(204, 255, 0, 0.5);
            transform: translateY(-5px);
            box-shadow: 0 10px 40px rgba(204, 255, 0, 0.1);
        }

        .feature-icon {
            font-size: 48px;
            margin-bottom: 20px;
            display: inline-block;
            color: var(--accent-lime);
        }

        .feature-card h3 {
            font-size: 20px; font-weight: 800; margin-bottom: 12px;
        }

        .feature-card p {
            color: var(--text-muted); font-size: 14px; line-height: 1.6;
        }

        /* How It Works */
        .how-it-works {
            padding: 100px 48px;
        }

        .steps-wrapper {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px;
            max-width: 1200px; margin: 0 auto;
        }

        .step {
            text-align: center; position: relative;
        }

        .step-number {
            width: 60px; height: 60px;
            background: linear-gradient(135deg, var(--accent-lime), #a8d400);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; font-weight: 900;
            color: #000;
            margin: 0 auto 24px;
        }

        .step h3 { font-size: 20px; font-weight: 800; margin-bottom: 12px; }
        .step p { color: var(--text-muted); font-size: 14px; line-height: 1.6; }

        /* Stats Section */
        .stats-section {
            padding: 80px 48px;
            background: rgba(204, 255, 0, 0.05);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .stats-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 40px;
            max-width: 1200px; margin: 0 auto;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 48px; font-weight: 900;
            color: var(--accent-lime);
            margin-bottom: 8px;
        }

        .stat-label {
            color: var(--text-muted); font-size: 14px; font-weight: 600;
        }

        /* Footer */
        .footer {
            padding: 60px 48px;
            border-top: 1px solid var(--border);
            text-align: center;
            color: var(--text-muted);
            font-size: 14px;
        }

        .footer-links {
            display: flex; justify-content: center; gap: 30px; margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .footer-link {
            color: var(--text-muted); text-decoration: none; transition: color 0.2s;
        }

        .footer-link:hover { color: var(--accent-lime); }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar { padding: 20px 24px; }
            .hero h1 { font-size: 40px; }
            .hero p { font-size: 15px; }
            .cards-wrapper { gap: 20px; }
            .card { padding: 30px 24px; }
            .section { padding: 60px 24px; }
            .section-title { font-size: 36px; }
            .nav-links { gap: 20px; }
        }

        /* Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>
<body>

    <div class="ambient-glow"></div>
    <div class="grid-overlay"></div>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="/" class="logo">✦ VOUCH</a>
        <div class="nav-links">
            <a href="#features" class="nav-link">Fitur</a>
            <a href="/login" class="nav-link">Masuk</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="badge">🚀 PLATFORM DONASI TERDEPAN</div>
        <h1>Ubah Cara<br>Mendukung Streamer</h1>
        <p>Lebih dari sekadar donasi. Sistem Escrow, Bounty Challenge, dan Squad Revenue Sharing yang mengubah interaksi antara streamer dan supporter.</p>

        <div class="cards-wrapper">
            <div class="card streamer">
                <div class="card-icon">🎮</div>
                <h2>Untuk Streamer</h2>
                <p>Monetisasi konten dengan tantangan berbayar. Terima Bounty dari audiens, buat squad kolaborasi, dan bagikan pendapatan secara otomatis.</p>
                <a href="/register?role=streamer" class="btn btn-lime">Mulai Sekarang</a>
                <a href="/login" class="login-hint">Punya akun? <span>Login di sini</span></a>
            </div>

            <div class="card supporter">
                <div class="card-icon">💎</div>
                <h2>Untuk Supporter</h2>
                <p>Tantang streamer favorit dengan sistem Escrow aman. Uang kamu terlindungi dan hanya cair jika tantangan berhasil diselesaikan.</p>
                <a href="/register?role=supporter" class="btn btn-purple">Daftar Supporter</a>
                <a href="/login" class="login-hint">Punya akun? <span>Login di sini</span></a>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section id="features" class="section">
        <h2 class="section-title">Fitur Unggulan</h2>
        <p class="section-subtitle">Teknologi terdepan untuk ekosistem streaming yang lebih baik</p>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <h3>Sistem Escrow</h3>
                <p>Dana supporter dijaga aman dalam sistem escrow. Pembayaran hanya dilepas saat tantangan berhasil diselesaikan.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h3>Bounty Challenge</h3>
                <p>Supporter bisa membuat tantangan dengan hadiah spesifik. Streamer menerima challenge dan menyelesaikannya untuk bonus.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">👥</div>
                <h3>Squad Auto-Split</h3>
                <p>Buat tim kolaborasi dan bagikan pendapatan secara otomatis. Setiap anggota squad dapat bagian sesuai kesepakatan.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Dashboard Analytics</h3>
                <p>Pantau performa, earnings, dan engagement secara real-time. Data lengkap untuk strategi monetisasi yang lebih baik.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3>Proses Instan</h3>
                <p>Verifikasi cepat, pencairan dana tanpa ribet. Semua transaksi diproses dalam hitungan menit.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🌐</div>
                <h3>Multi Platform</h3>
                <p>Akses dari mana saja, kapan saja. Desktop, mobile, dan terintegrasi dengan platform streaming populer.</p>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works">
        <h2 class="section-title">Cara Kerja</h2>
        <p class="section-subtitle">3 Langkah Mudah untuk Mulai Menggunakan VOUCH</p>

        <div class="steps-wrapper">
            <div class="step">
                <div class="step-number">1</div>
                <h3>Daftar & Setup</h3>
                <p>Buat akun sebagai streamer atau supporter. Lengkapi profil dan verifikasi identitas Anda dalam beberapa menit.</p>
            </div>

            <div class="step">
                <div class="step-number">2</div>
                <h3>Buat atau Terima Challenge</h3>
                <p>Supporter membuat bounty, streamer menerima challenge. Tentukan target, hadiah, dan waktu penyelesaian.</p>
            </div>

            <div class="step">
                <div class="step-number">3</div>
                <h3>Selesaikan & Dapatkan Reward</h3>
                <p>Setelah challenge diselesaikan, pembayaran langsung ditransfer. Nikmati earnings tanpa potongan berlebihan.</p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">10K+</div>
                <div class="stat-label">Streamer Aktif</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">50K+</div>
                <div class="stat-label">Supporter Terdaftar</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">$5M+</div>
                <div class="stat-label">Dana Tersalurkan</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">99.8%</div>
                <div class="stat-label">Kepuasan Pengguna</div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-links">
            <a href="#" class="footer-link">Tentang</a>
            <a href="#" class="footer-link">Kebijakan Privasi</a>
            <a href="#" class="footer-link">Syarat Layanan</a>
            <a href="#" class="footer-link">Kontak</a>
        </div>
        <p>&copy; 2026 VOUCH. Platform Donasi Streaming Terpercaya. Semua Hak Dilindungi.</p>
    </footer>

</body>
</html> 