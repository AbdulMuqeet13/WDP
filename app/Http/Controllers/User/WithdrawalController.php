<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())
            ->where('type', 'withdraw')
            ->latest()
            ->get();

        return inertia('User/Withdrawals/Index', [
            'transactions' => $transactions,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|gt:0',
        ]);

        $user = Auth::user();

        // Ensure wallet has enough funds
        if ($user->balance < $request->amount) {
            return back()->with('error', 'Insufficient balance for withdrawal.');
        }

        // Prevent duplicate pending withdrawals
        $pending = Transaction::where('user_id', $user->id)
            ->where('type', 'withdraw')
            ->where('status', 'pending')
            ->exists();

        if ($pending) {
            return back()->with('error', 'You already have a pending withdrawal request.');
        }

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'withdraw',
            'amount' => $request->amount,
            'status' => 'pending',
            'description' => 'Withdrawal request awaiting admin approval',
        ]);

        return back()->with('success', 'Withdrawal request sent for admin approval.');
    }
}
