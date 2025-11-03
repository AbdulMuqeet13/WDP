<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Transaction\CreateTransactionRequest;
use App\Http\Resources\UserTransactionResource;
use App\Models\User;
use App\Models\UserTransaction;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function index()
    {
        $transactions = UserTransaction::query()->where('user_id', Auth::id())
            ->where('type', 'deposit')
            ->latest()
            ->get();

        return inertia('User/Deposits/Index', [
            'transactions' => UserTransactionResource::collection($transactions)->resolve(),
        ]);
    }

    public function store(CreateTransactionRequest $request)
    {
        $data = $request->validated();

        $user = Auth::user();

        // Prevent duplicate pending deposits
        $pending = UserTransaction::query()->where('user_id', $user->id)
            ->where('type', 'deposit')
            ->where('status', 'pending')
            ->exists();

        $path = null;
        if ($request->hasFile('screenshot')) {
            $path = $request->file('screenshot')->store('deposits', 'public');
        }

        if ($pending) {
            return back()->with('error', 'You already have a pending deposit request.');
        }

        UserTransaction::query()->create([
            'user_id' => $user->id,
            'payable_type' => User::class,
            'type' => 'deposit',
            'amount' => $data['amount'],
            'status' => 'pending',
            'description' => 'Deposit request awaiting admin approval',
            'screenshot' => $path,
        ]);

        return back()->with('success', 'Deposit request submitted for admin approval.');
    }
}
