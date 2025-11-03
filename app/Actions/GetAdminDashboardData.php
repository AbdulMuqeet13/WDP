<?php

namespace App\Actions;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserTransaction;
use App\Models\Transaction;

class GetAdminDashboardData
{
    public static function handle(User $user, string $referralUrl): array
    {
        $totalUsers = User::query()->role(['user'])->count();
        $totalCTO = User::query()->role(['user'])->where('is_cto', 1)->count();
        $totalIncome = Transaction::query()->whereJsonContains('meta->type', 'User Deposit')->sumAmountFloat('amount');
        $pendingDeposits = UserTransaction::query()->where('type', 'deposit')->where('status', 'pending')->count();
        $pendingWithdrawals = UserTransaction::query()->where('type', 'withdraw')->where('status', 'pending')->count();
        $totalWithdrawals = Transaction::query()->whereJsonContains('meta->type', 'User Withdraw')->sumAmountFloat('amount');
        $todayWithdrawals = Transaction::query()->whereToday('created_at')->whereJsonContains('meta->type', 'User Withdraw')->sumAmountFloat('amount');
        $todayJoined = User::query()->whereToday('created_at')->count();
        $todayActive = User::query()->whereToday('created_at')->active()->count();
        $todayROI = Transaction::query()
            ->whereJsonContains('meta->type', 'ROI Credit')
            ->whereToday('created_at')
            ->sumAmountFloat('amount');
        $sponsorIncomeTypes = ['Sponsor Income', 'ROI Credit', 'Level Income', 'CTO Royalty'];
        $totalSponsorIncome = Transaction::query()
            ->where(function ($query) use ($sponsorIncomeTypes) {
                foreach ($sponsorIncomeTypes as $type) {
                    $query->orWhereJsonContains('meta->type', $type);
                }
            })
            ->sumAmountFloat('amount');
        $totalCtoIncome = Transaction::query()->whereJsonContains('meta->type', 'CTO Royalty')->sumAmountFloat('amount');

        $recentUsers = User::query()->latest()->take(5)->get(['name', 'email', 'created_at']);

        return [
            'user' => new UserResource($user),
            'referral_url' => $referralUrl,
            'role' => 'admin',
            'stats' => [
                'total_users' => $totalUsers,
                'total_CTOs' => $totalCTO,
                'total_business' => '$' . number_format($totalIncome, 2),
                'pending_deposits' => $pendingDeposits,
                'pending_withdrawals' => $pendingWithdrawals,
                'total_withdrawals' => '$' . number_format(abs($totalWithdrawals), 2),
                'today_withdrawals' => '$' . number_format(abs($todayWithdrawals), 2),
                'today_joined' => $todayJoined,
                'today_active' => $todayActive,
                'today_ROI' => '$' . number_format($todayROI, 2),
                'total_sponsor_income' => '$' . number_format($totalSponsorIncome, 2),
                'total_CTO_income' => '$' . number_format($totalCtoIncome, 2),
            ],
            'recent_users' => UserResource::collection($recentUsers)->resolve(),
        ];
    }
}
