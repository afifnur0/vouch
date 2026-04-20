<?php

namespace App\Http\Controllers;

use App\Models\Bounty;
use App\Models\Squad;
use App\Models\StreamerProfile;
use Illuminate\Http\Request;

class StreamerDashboardController extends Controller
{
    public function index()
    {
        // 1. Proteksi: Tendang ke halaman login jika user belum masuk
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();
        
        $isOnboarded = $user->is_onboarded; 
        $streamerId = $user->id; 

        // 2. Ambil data Bounties & Hitung Total Dana Tertahan (Escrow)
        $activeBounties = Bounty::where('streamer_id', $streamerId)
            ->where('status', 'locked_in_escrow')->get();
            
        $escrowTotal = $activeBounties->sum('amount');

        // 3. Ambil data Squad
        $mySquads = Squad::whereHas('members', function($q) use ($streamerId) {
            $q->where('streamer_id', $streamerId);
        })->with('members.streamer')->get();

        // 4. Simulasi Saldo & Riwayat (Nantinya diambil dari tabel transactions/donations)
        $availableBalance = $user->balance ?? 0; // Pastikan nanti Anda membuat kolom 'balance' di tabel users
        $recentActivities = []; // Kosong untuk memicu desain "Empty State"
        
        // 5. Generate Link Utilities
        $publicLink = url('/' . $user->name);
        $obsLink = url('/overlay/' . md5($user->id . 'rahasia') . '/alert');

        return view('streamer.dashboard', compact(
            'activeBounties', 'mySquads', 'isOnboarded', 
            'escrowTotal', 'availableBalance', 'recentActivities',
            'publicLink', 'obsLink'
        ));
    }

    public function processSetup(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'nik_number' => 'required|numeric',
            'bank_name' => 'required|string',
            'account_number' => 'required|numeric',
        ]);

        $user = auth()->user();

        StreamerProfile::create([
            'user_id' => $user->id,
            'full_name' => $request->full_name,
            'nik_number' => $request->nik_number,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
        ]);

        $user->is_onboarded = true;
        $user->save();

        return redirect('/dashboard')->with('success', 'Verifikasi berhasil! Fitur dashboard kini terbuka.');
    }

    public function claimBounty($id)
    {
        $bounty = Bounty::findOrFail($id);
        $bounty->update(['status' => 'completed']);
        return back()->with('success', 'Klaim berhasil dikirim!');
    }
// Letakkan di bawah fungsi index() atau processSetup()
  public function settings()
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();
        if (!$user->is_onboarded) {
            return redirect('/dashboard')->withErrors('Selesaikan verifikasi profil terlebih dahulu.');
        }

        // Ambil pengaturan yang sudah ada dari relasi model (bisa null jika belum pernah diset)
        $settings = $user->settings;

        return view('streamer.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $user = auth()->user();

        // 1. Olah data string yang dipisahkan koma menjadi Array (JSON)
        $presetAmounts = $request->preset_amounts 
            ? array_map('trim', explode(',', $request->preset_amounts)) 
            : null;
            
        $bannedWords = $request->custom_banned_words 
            ? array_map('trim', explode(',', $request->custom_banned_words)) 
            : null;

        // 2. Simpan atau Perbarui (UpdateOrCreate)
        \App\Models\StreamerSetting::updateOrCreate(
            ['user_id' => $user->id], // Cari berdasarkan user_id
            [
                // Overlay
                'alert_image_url' => $request->alert_image_url,
                'alert_sound_url' => $request->alert_sound_url,
                'tts_minimum_amount' => $request->tts_minimum_amount ?? 10000,
                
                // Public Page
                'page_bio' => $request->page_bio,
                'preset_amounts' => $presetAmounts,
                
                // Media Share (Jika checkbox dicentang, nilainya ada, jika tidak, false)
                'is_media_share_enabled' => $request->has('is_media_share_enabled'),
                'media_share_minimum_amount' => $request->media_share_minimum_amount ?? 50000,
                
                // Milestone
                'is_milestone_enabled' => $request->has('is_milestone_enabled'),
                'milestone_title' => $request->milestone_title,
                'milestone_target_amount' => $request->milestone_target_amount,
                
                // Filter
                'is_default_filter_enabled' => $request->has('is_default_filter_enabled'),
                'custom_banned_words' => $bannedWords,
            ]
        );

        // 3. Kembalikan ke halaman dengan pesan sukses
        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}