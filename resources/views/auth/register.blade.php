<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - VOUCH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #05060f;
            --bg-panel: rgba(255, 255, 255, 0.03);
            --accent-lime: #ccff00;
            --accent-purple: #9945ff;
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
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
        }

        /* Background Effects */
        .bg-glow {
            position: fixed;
            top: -50%; left: 50%;
            width: 100vw; height: 100vh;
            background: radial-gradient(circle, rgba(204, 255, 0, 0.08), transparent 60%);
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

        .auth-container {
            width: 100%;
            max-width: 480px;
            padding: 20px;
            z-index: 1;
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

        .logo-area {
            text-align: center;
            margin-bottom: 48px;
            animation: slideDown 0.6s ease;
        }

        .logo-area a {
            font-size: 32px;
            font-weight: 900;
            color: var(--accent-lime);
            text-decoration: none;
            letter-spacing: -1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
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

        .auth-panel {
            background: rgba(10, 12, 20, 0.5);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 50px 40px;
            backdrop-filter: blur(20px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.8s ease 0.1s both;
        }

        .auth-header {
            margin-bottom: 32px;
            text-align: center;
        }

        .auth-icon {
            font-size: 48px;
            margin-bottom: 20px;
            display: block;
        }

        .role-badge {
            display: inline-block;
            padding: 8px 18px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 800;
            margin-bottom: 16px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            background: rgba(204, 255, 0, 0.15);
            color: var(--accent-lime);
            border: 1px solid rgba(204, 255, 0, 0.3);
            animation: slideDown 0.6s ease 0.1s both;
        }

        .role-badge.supporter {
            background: rgba(153, 69, 255, 0.15);
            color: #b89fff;
            border-color: rgba(153, 69, 255, 0.3);
        }

        .auth-title {
            font-size: 28px;
            font-weight: 900;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #ccff00, #ffffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: slideDown 0.6s ease 0.2s both;
        }

        .auth-subtitle {
            color: var(--text-muted);
            font-size: 14px;
            line-height: 1.5;
            animation: slideDown 0.6s ease 0.3s both;
        }

        .form-group {
            margin-bottom: 24px;
            animation: slideUp 0.6s ease;
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

        .form-group:nth-child(1) { animation-delay: 0.3s; }
        .form-group:nth-child(2) { animation-delay: 0.4s; }
        .form-group:nth-child(3) { animation-delay: 0.5s; }

        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, var(--accent-lime), #a8d400);
            color: #000;
            border: none;
            padding: 14px;
            font-size: 14px;
            font-weight: 800;
            border-radius: 12px;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 5px 20px rgba(204, 255, 0, 0.2);
            animation: slideUp 0.6s ease 0.6s both;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(204, 255, 0, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .auth-footer {
            text-align: center;
            margin-top: 28px;
            font-size: 14px;
            color: var(--text-muted);
            animation: slideUp 0.6s ease 0.7s both;
        }

        .auth-footer a {
            color: var(--accent-lime);
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s;
        }

        .auth-footer a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        .feature-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            animation: slideUp 0.6s ease 0.8s both;
        }

        .feature-tag {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--text-muted);
            background: rgba(255, 255, 255, 0.05);
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid var(--border);
        }

        .feature-tag i {
            color: var(--accent-lime);
        }

        /* Responsive */
        @media (max-width: 480px) {
            .auth-panel {
                padding: 30px 24px;
            }
            .auth-title {
                font-size: 24px;
            }
            .logo-area a {
                font-size: 28px;
            }
            .feature-tags {
                flex-direction: column;
            }
            .feature-tag {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="bg-glow"></div>
    <div class="grid-overlay"></div>

    <div class="auth-container">
        <div class="logo-area">
            <a href="/">✦ VOUCH</a>
        </div>

        <div class="auth-panel">
            <div class="auth-header">
                @if($role === 'streamer')
                    <span class="auth-icon">🎮</span>
                    <div class="role-badge">Streamer Registration</div>
                    <h1 class="auth-title">Mulai Monetisasi</h1>
                    <p class="auth-subtitle">Terima bounty, buat squad, dan raih penghasilan lebih.</p>
                @else
                    <span class="auth-icon">💎</span>
                    <div class="role-badge supporter">Supporter Registration</div>
                    <h1 class="auth-title">Dukung Streamer</h1>
                    <p class="auth-subtitle">Tantang streamer favorimu dengan sistem aman.</p>
                @endif
            </div>

            <form action="/register" method="POST">
                @csrf
                <input type="hidden" name="role" value="{{ $role }}">

                <div class="form-group">
                    <label class="form-label">👤 Username / Nama Channel</label>
                    <input type="text" class="form-control" name="username" placeholder="Contoh: nama_channel" required>
                </div>

                <div class="form-group">
                    <label class="form-label">📧 Alamat Email</label>
                    <input type="email" class="form-control" name="email" placeholder="email@domain.com" required>
                </div>

                <div class="form-group">
                    <label class="form-label">🔑 Kata Sandi</label>
                    <input type="password" class="form-control" name="password" placeholder="Minimal 8 karakter" required>
                </div>

                <button type="submit" class="btn-submit">Daftar Sekarang</button>
            </form>

            <div class="feature-tags">
                <div class="feature-tag">✓ Gratis</div>
                <div class="feature-tag">✓ Aman</div>
                <div class="feature-tag">✓ Cepat</div>
            </div>

            <div class="auth-footer">
                Sudah punya akun? <a href="/login">Masuk di sini</a>
            </div>
        </div>
    </div>

</body>
</html>