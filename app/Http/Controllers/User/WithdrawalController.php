<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserTransactionResource;
use App\Models\UserTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function index()
    {
        $transactions = UserTransaction::query()->where('user_id', Auth::id())
            ->where('type', 'withdraw')
            ->latest()
            ->get();

        return inertia('User/Withdrawals/Index', [
            'transactions' => UserTransactionResource::collection($transactions)->resolve(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|gt:0',
            'wallet_address' => 'required|string'
        ]);

        $user = Auth::user();

        // Ensure wallet has enough funds
        if ($user->balance < $request->amount) {
            return back()->with('error', 'Insufficient balance for withdrawal.');
        }

        // Prevent duplicate pending withdrawals
        $pending = UserTransaction::query()->where('user_id', $user->id)
            ->where('type', 'withdraw')
            ->where('status', 'pending')
            ->exists();

        if ($pending) {
            return back()->with('error', 'You already have a pending withdrawal request.');
        }

        UserTransaction::query()->create([
            'user_id' => $user->id,
            'type' => 'withdraw',
            'amount' => $request->amount,
            'status' => 'pending',
            'description' => 'Withdrawal request awaiting admin approval',
            'wallet_address' => $request->wallet_address,
        ]);

        return back()->with('success', 'Withdrawal request sent for admin approval.');
    }
}
