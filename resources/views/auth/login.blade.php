<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - VOUCH</title>
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
            max-width: 450px;
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

        .auth-icon {
            text-align: center;
            margin-bottom: 32px;
            font-size: 48px;
        }

        .auth-title {
            font-size: 28px;
            font-weight: 900;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #ccff00, #ffffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .auth-subtitle {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 32px;
            line-height: 1.5;
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

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }

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

        .error-message {
            background: rgba(255, 51, 102, 0.1);
            border: 1px solid var(--accent-red);
            color: #ff9db3;
            padding: 14px 16px;
            border-radius: 12px;
            font-size: 13px;
            margin-bottom: 24px;
            font-weight: 600;
            animation: shake 0.4s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .error-message::before {
            content: '⚠️';
            font-size: 16px;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
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
            <div class="auth-icon">🔐</div>
            <h1 class="auth-title">Selamat Datang Kembali</h1>
            <p class="auth-subtitle">Masuk ke portal VOUCH dan kelola akun Anda sekarang.</p>

            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="/login" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">📧 Alamat Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="email@domain.com" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label">🔑 Kata Sandi</label>
                    <input type="password" class="form-control" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-submit">Masuk ke Portal</button>
            </form>

            <div class="auth-footer">
                Belum punya akun? <a href="/">Daftar sekarang</a>
            </div>
        </div>
    </div>

</body>
</html>