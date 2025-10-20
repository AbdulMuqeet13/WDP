<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Transaction\CreateTransactionRequest;
use Bavix\Wallet\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('payable_id', Auth::id())
            ->where('type', 'deposit')
            ->latest()
            ->get();

        return inertia('User/Deposits/Index', [
            'transactions' => $transactions,
        ]);
    }

    public function store(CreateTransactionRequest $request)
    {
        $data = $request->validated();

        $user = Auth::user();

        // Prevent duplicate pending deposits
        $pending = Transaction::where('payable_id', $user->id)
            ->where('type', 'deposit')
            ->where('status', 'pending')
            ->exists();

        if ($pending) {
            return back()->with('error', 'You already have a pending deposit request.');
        }

        Transaction::create([
            'payable_id' => $user->id,
            'type' => 'deposit',
            'amount' => $data['amount'],
            'status' => 'pending',
            'description' => 'Deposit request awaiting admin approval',
        ]);

        return back()->with('success', 'Deposit request submitted for admin approval.');
    }
}
