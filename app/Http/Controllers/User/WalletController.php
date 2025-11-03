<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WalletController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get wallet transactions from laravel-wallet package
        $walletTransactions = $user->transactions()
            ->latest()
            ->take(50)
            ->get();

        return Inertia::render('User/Wallet/Index', [
            'balance' => $user->balanceFloat,
            'transactions' => TransactionResource::collection($walletTransactions)->resolve(),
        ]);
    }
}
