<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supporter Dashboard - VOUCH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #05060f; --bg-panel: rgba(255, 255, 255, 0.03);
            --accent-lime: #ccff00; --accent-white: #ffffff;
            --text-main: #ffffff; --text-muted: #8b92a5; --border: rgba(255, 255, 255, 0.1);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-dark); color: var(--text-main); min-height: 100vh; padding-bottom: 60px; }
        
        .navbar {
            display: flex; justify-content: space-between; align-items: center;
            padding: 20px 40px; border-bottom: 1px solid var(--border);
            background: rgba(5, 6, 15, 0.8); backdrop-filter: blur(10px);
            position: sticky; top: 0; z-index: 100;
        }
        .logo { font-size: 24px; font-weight: 900; color: var(--accent-lime); letter-spacing: -1px; text-decoration: none;}
        
        .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 32px; }
        .main-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 24px; }
        
        .panel { background: var(--bg-panel); border: 1px solid var(--border); border-radius: 16px; padding: 24px; }
        .panel-header { font-size: 14px; font-weight: 800; letter-spacing: 2px; color: var(--text-muted); margin-bottom: 20px; border-bottom: 1px solid var(--border); padding-bottom: 10px; text-transform: uppercase; }

        .stat-card { background: rgba(0,0,0,0.4); border: 1px solid var(--border); border-radius: 12px; padding: 24px; }
        .stat-label { color: var(--text-muted); font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
        .stat-value { font-size: 36px; font-weight: 900; color: #fff; }
        
        .btn-explore { background: var(--accent-white); color: #000; border: none; padding: 14px 24px; font-weight: 800; border-radius: 8px; cursor: pointer; text-transform: uppercase; margin-top: 16px; display: inline-block; text-decoration: none; font-size: 14px; }
        .btn-explore:hover { background: #e6e6e6; }

        .empty-state { text-align: center; padding: 40px 20px; color: var(--text-muted); border: 1px dashed var(--border); border-radius: 12px; font-size: 14px; }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="/" class="logo">VOUCH //</a>
        <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center; gap: 16px;">
            <span style="color: var(--text-muted);">{{ auth()->user()->name }} (Supporter)</span>
            <form action="/logout" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" style="background: transparent; color: #ff3366; border: 1px solid #ff3366; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-weight: bold;">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Dana Anda di Escrow (Aktif)</div>
                <div class="stat-value">Rp {{ number_format($totalEscrow, 0, ',', '.') }}</div>
                <div style="font-size: 11px; color: var(--text-muted); margin-top: 12px;">*Dana ini akan dikembalikan jika streamer gagal menyelesaikan quest.</div>
            </div>
            
            <div class="stat-card" style="display: flex; flex-direction: column; justify-content: center; align-items: flex-start; background: linear-gradient(135deg, rgba(255,255,255,0.05), rgba(0,0,0,0.8));">
                <h3 style="margin-bottom: 8px;">Dukung Kreator Favoritmu</h3>
                <p style="font-size: 14px; color: var(--text-muted);">Beri mereka tantangan dan bayar jika berhasil.</p>
                <a href="#" class="btn-explore">Eksplor Streamer</a>
            </div>
        </div>

        <div class="main-grid">
            <div class="panel">
                <div class="panel-header">Quest yang Anda Berikan (Bounties)</div>
                
                @forelse($myBounties as $bounty)
                    @empty
                    <div class="empty-state">
                        Anda belum memberikan tantangan (Bounty) kepada siapapun.
                    </div>
                @endforelse
            </div>

            <div class="panel" style="align-self: start;">
                <div class="panel-header">Riwayat Donasi Langsung</div>
                <div class="empty-state">
                    Belum ada riwayat transaksi.
                </div>
            </div>
        </div>

    </div>

</body>
</html>

