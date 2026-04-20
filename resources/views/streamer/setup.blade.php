<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Verifikasi - VOUCH</title>
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
            background: rgba(5, 6, 15, 0.7);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
        }
        .logo { font-size: 24px; font-weight: 900; color: var(--accent-lime); text-decoration: none; letter-spacing: -1px; }
        .nav-link { color: #fff; text-decoration: none; font-size: 14px; font-weight: 600; transition: color 0.2s; }
        .nav-link:hover { color: var(--accent-lime); }

        .container {
            max-width: 700px;
            margin: 60px auto;
            padding: 0 20px;
            animation: slideUp 0.6s ease;
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

        .hero-section {
            text-align: center;
            margin-bottom: 60px;
        }

        .hero-icon {
            font-size: 64px;
            margin-bottom: 24px;
            display: block;
        }

        .hero-title {
            font-size: 36px;
            font-weight: 900;
            margin-bottom: 16px;
            background: linear-gradient(135deg, #ccff00, #ffffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            color: var(--text-muted);
            font-size: 16px;
            line-height: 1.6;
            max-width: 500px;
            margin: 0 auto;
        }

        .setup-section {
            background: rgba(10, 12, 20, 0.5);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 32px;
            backdrop-filter: blur(20px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.6s ease;
        }

        .setup-section:nth-child(1) { animation-delay: 0.1s; }
        .setup-section:nth-child(2) { animation-delay: 0.2s; }
        .setup-section:nth-child(3) { animation-delay: 0.3s; }

        .section-title {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 24px;
            color: var(--accent-lime);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title::before {
            content: '';
            width: 8px;
            height: 8px;
            background: var(--accent-lime);
            border-radius: 50%;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: var(--text-muted);
            margin-bottom: 10px;
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

        select.form-control {
            cursor: pointer;
        }

        .form-note {
            font-size: 11px;
            color: var(--accent-red);
            margin-top: 8px;
            font-weight: 600;
        }

        .btn-connect {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            background: linear-gradient(135deg, #ff0000, #cc0000);
            color: white;
            border: none;
            padding: 14px;
            font-weight: 700;
            border-radius: 12px;
            cursor: pointer;
            margin-bottom: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(255, 0, 0, 0.2);
        }

        .btn-connect:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(255, 0, 0, 0.3);
        }

        .btn-connect.twitch {
            background: linear-gradient(135deg, #9146FF, #772ce8);
            box-shadow: 0 5px 20px rgba(145, 70, 255, 0.2);
        }

        .btn-connect.twitch:hover {
            box-shadow: 0 10px 30px rgba(145, 70, 255, 0.3);
        }

        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, var(--accent-lime), #a8d400);
            color: #000;
            border: none;
            padding: 16px;
            font-size: 16px;
            font-weight: 900;
            border-radius: 12px;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            margin-top: 20px;
            box-shadow: 0 5px 20px rgba(204, 255, 0, 0.2);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(204, 255, 0, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .error-message {
            background: rgba(255, 51, 102, 0.1);
            border: 1px solid var(--accent-red);
            color: #ff9db3;
            padding: 16px;
            border-radius: 12px;
            font-size: 13px;
            margin-bottom: 32px;
            font-weight: 600;
            animation: shake 0.4s ease;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .error-message::before {
            content: '⚠️';
            font-size: 18px;
            flex-shrink: 0;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .optional-section {
            border-style: dashed !important;
            opacity: 0.8;
        }

        .optional-section .section-title {
            color: var(--text-muted);
        }

        .optional-section .section-title::before {
            background: var(--text-muted);
        }

        /* Progress Indicator */
        .progress-container {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
        }

        .progress-steps {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--text-muted);
            transition: all 0.3s ease;
        }

        .step.active .step-circle {
            background: var(--accent-lime);
            border-color: var(--accent-lime);
            color: #000;
        }

        .step.completed .step-circle {
            background: var(--accent-lime);
            border-color: var(--accent-lime);
            color: #000;
        }

        .step-label {
            font-size: 11px;
            color: var(--text-muted);
            text-align: center;
            font-weight: 600;
        }

        .step.active .step-label {
            color: var(--accent-lime);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar { padding: 20px 24px; }
            .container { margin: 40px auto; }
            .hero-title { font-size: 28px; }
            .setup-section { padding: 24px; }
            .progress-steps { gap: 12px; }
            .step-circle { width: 32px; height: 32px; font-size: 12px; }
        }
    </style>
</head>
<body>
    <div class="bg-glow"></div>
    <div class="grid-overlay"></div>

    <nav class="navbar">
        <a href="/" class="logo">✦ VOUCH</a>
        <a href="/dashboard" class="nav-link">← Dashboard</a>
    </nav>

    <div class="container">
        <div class="hero-section">
            <span class="hero-icon">🔐</span>
            <h1 class="hero-title">Verifikasi Akun</h1>
            <p class="hero-subtitle">Selesaikan 2 langkah ini untuk mengaktifkan fitur pencairan dana dan penerimaan donasi.</p>
        </div>

        <div class="progress-container">
            <div class="progress-steps">
                <div class="step active">
                    <div class="step-circle">1</div>
                    <div class="step-label">KYC</div>
                </div>
                <div class="step">
                    <div class="step-circle">2</div>
                    <div class="step-label">Bank</div>
                </div>
                <div class="step">
                    <div class="step-circle">3</div>
                    <div class="step-label">Opsional</div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="error-message">
                <div>
                    <strong>Gagal menyimpan:</strong>
                    <ul style="margin-top: 8px; margin-left: 16px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="/dashboard/setup" method="POST">
            @csrf

            <div class="setup-section">
                <div class="section-title">1. Identitas Sesuai KTP (KYC)</div>
                <div class="form-group">
                    <label class="form-label">👤 Nama Lengkap Asli</label>
                    <input type="text" class="form-control" name="full_name" placeholder="Harus sesuai KTP" required>
                </div>
                <div class="form-group">
                    <label class="form-label">🆔 Nomor Induk Kependudukan (NIK)</label>
                    <input type="number" class="form-control" name="nik_number" placeholder="16 Digit NIK" required>
                </div>
            </div>

            <div class="setup-section">
                <div class="section-title">2. Rekening Pencairan</div>
                <div class="form-group">
                    <label class="form-label">🏦 Bank / E-Wallet</label>
                    <select class="form-control" name="bank_name" required>
                        <option value="">Pilih Bank/E-Wallet</option>
                        <option value="BCA">🏦 BCA</option>
                        <option value="Mandiri">🏦 Mandiri</option>
                        <option value="BNI">🏦 BNI</option>
                        <option value="BRI">🏦 BRI</option>
                        <option value="GoPay">📱 GoPay</option>
                        <option value="OVO">📱 OVO</option>
                        <option value="DANA">📱 DANA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">💳 Nomor Rekening</label>
                    <input type="number" class="form-control" name="account_number" placeholder="Nomor rekening" required>
                    <div class="form-note">* Nama di rekening wajib sama dengan nama KTP.</div>
                </div>
            </div>

            <div class="setup-section optional-section">
                <div class="section-title">3. Tautkan Platform Live (Opsional)</div>
                <p style="font-size: 12px; color: var(--text-muted); margin-bottom: 20px;">Tautkan akun untuk kemudahan setup overlay notifikasi.</p>
                <button type="button" class="btn-connect" style="background: linear-gradient(135deg, #ff0000, #cc0000);">
                    <i class="bi bi-youtube"></i> Hubungkan YouTube
                </button>
                <button type="button" class="btn-connect twitch" style="background: linear-gradient(135deg, #9146FF, #772ce8);">
                    <i class="bi bi-twitch"></i> Hubungkan Twitch
                </button>
            </div>

            <button type="submit" class="btn-submit">Kirim & Verifikasi</button>
        </form>
    </div>

</body>
</html>