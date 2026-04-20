<?php

namespace App\Http\Controllers;

use App\Models\Bounty;
use Illuminate\Http\Request;

class SupporterDashboardController extends Controller
{
    public function index()
    {
        if (!auth()->check() || auth()->user()->role !== 'supporter') {
            return redirect('/login');
        }

        $user = auth()->user();

        // Ambil data tantangan (bounty) yang dibuat oleh supporter ini
        $myBounties = Bounty::where('donator_id', $user->id)->with('streamer')->get();
        
        // Hitung total uang yang sedang ditahan di sistem Escrow
        $totalEscrow = $myBounties->where('status', 'locked_in_escrow')->sum('amount');

        return view('supporter.dashboard', compact('myBounties', 'totalEscrow'));
    }
}