<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Models\UserTransaction;
use Bavix\Wallet\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->loadCount('directReferrals')->load('referrer');

        $referralUrl = url('/register?ref=' . $user->referral_code);

        if ($user->hasRole('admin')) {
            // Admin dashboard data
            $totalUsers = User::count();
            $totalIncome = UserTransaction::where('type', 'deposit')->sum('amount');
            $pendingDeposits = UserTransaction::where('type', 'deposit')->where('status', 'pending')->count();
            $pendingWithdrawals = UserTransaction::where('type', 'withdraw')->where('status', 'pending')->count();

            $recentUsers = User::latest()->take(5)->get(['name', 'email', 'created_at']);

            return Inertia::render('Dashboard', [
                'user' => new UserResource($user),
                'referral_url' => $referralUrl,
                'role' => 'admin',
                'stats' => [
                    'total_users' => $totalUsers,
                    'total_income' => $totalIncome,
                    'pending_deposits' => $pendingDeposits,
                    'pending_withdrawals' => $pendingWithdrawals,
                ],
                'recent_users' => UserResource::collection($recentUsers)->resolve(),
            ]);
        }

        // User dashboard data
        $networkMembers = $user->getNetworkMembersCount();
        $networkIncome = Transaction::query()->whereJsonContains('meta->referrer_id', $user->referrer_id)->sum('amount') ?? 0;
        $totalDeposits = $user->transactions()->whereJsonContains('meta->type', 'User Deposit')->sum('amount');
        $totalWithdrawals = $user->transactions()->whereJsonContains('meta->type', 'User Withdraw')->sum('amount');
        $recentReferrals = $user->directReferrals()
            ->latest()
            ->take(5)
            ->get(['name', 'email', 'created_at']);

        return Inertia::render('Dashboard', [
            'user' => new UserResource($user),
            'referral_url' => $referralUrl,
            'role' => 'user',
            'stats' => [
                'network_members' => $networkMembers,
                'network_income' => number_format($networkIncome, 2),
                'total_deposits' => number_format($totalDeposits, 2),
                'total_withdrawals' => number_format($totalWithdrawals, 2),
            ],
            'recent_referrals' => UserResource::collection($recentReferrals)->resolve(),
        ]);
    }
}
