<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
            ->get()
            ->map(function ($t) {
                return [
                    'amount' => $t->amount,
                    'type' => $t->type,
                    'meta' => $t->meta,
                    'confirmed' => $t->confirmed,
                    'created_at' => $t->created_at->toDateTimeString(),
                ];
            });

        return Inertia::render('User/Wallet/Index', [
            'balance' => $user->balance,
            'transactions' => $walletTransactions,
        ]);
    }
}
