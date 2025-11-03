<?php

namespace App\Actions;

use App\Http\Resources\UserResource;
use App\Models\Transaction;

class GetUserDashboardData
{
    public static function handle($user, $referralUrl): array
    {
        $networkMembers = $user->getNetworkMembersCount();
        $networkIncome = Transaction::query()->whereJsonContains('meta->referrer_id', $user->referrer_id)->sumAmountFloat('amount') ?? 0;
        $totalDeposits = $user->transactions()->whereJsonContains('meta->type', 'User Deposit')->sumAmountFloat('amount');
        $totalWithdrawals = $user->transactions()->whereJsonContains('meta->type', 'User Withdraw')->sumAmountFloat('amount');
        $recentReferrals = $user->directReferrals()
            ->latest()
            ->take(5)
            ->get(['name', 'email', 'created_at']);

        // ✅ Self investment totals
        $selfInvestment = $user->transactions()
            ->whereJsonContains('meta->type', 'User Deposit')
            ->sumAmountFloat('amount');

        // ✅ Calculate progress for rewards
        $thailandTarget = 2000;
        $dubaiTarget = 5000;
        $ctoReferrals = 20;
        $ctoMinInvestment = 50;

        $thailandProgress = min(100, ($selfInvestment / $thailandTarget) * 100);
        $dubaiProgress = min(100, ($selfInvestment / $dubaiTarget) * 100);

        // ✅ Check if all direct referrals invested at least $50
        $qualifiedReferrals = $user->directReferrals->filter(function ($ref) use ($ctoMinInvestment) {
            $refDeposit = $ref->transactions()
                ->whereJsonContains('meta->type', 'User Deposit')
                ->sumAmountFloat('amount');

            return $refDeposit >= $ctoMinInvestment;
        })->count();

        $ctoProgress = min(100, ($qualifiedReferrals / $ctoReferrals) * 100);

        $dailyROI = $user->transactions()
            ->whereJsonContains('meta->type', 'ROI Credit')
            ->whereToday('created_at')
            ->sumAmountFloat('amount');

        $sponsorIncome = $user->transactions()
            ->whereJsonContains('meta->type', 'Sponsor Income')
            ->sumAmountFloat('amount');

        $ctoIncome = $user->transactions()
            ->whereJsonContains('meta->type', 'CTO Royalty')
            ->sumAmountFloat('amount');

        $userIncomeTypes = ['Sponsor Income', 'ROI Credit', 'Level Income', 'CTO Royalty'];
        $totalUserIncome = $user->transactions()
            ->where(function ($query) use ($userIncomeTypes) {
                foreach ($userIncomeTypes as $type) {
                    $query->orWhereJsonContains('meta->type', $type);
                }
            })
            ->sumAmountFloat('amount');
        // Total wallet balance (optional)
        $walletBalance = $totalUserIncome ?? 0;

        return [
            'user' => new UserResource($user),
            'referral_url' => $referralUrl,
            'role' => 'user',
            'stats' => [
                'network_members' => $networkMembers,
                'network_income' => '$' . number_format($networkIncome, 2),
                'total_deposits' => '$' . number_format($totalDeposits, 2),
                'total_withdrawals' => '$' . number_format(abs($totalWithdrawals), 2),
                'daily_ROI' => '$' . number_format($dailyROI, 2),
                'sponsor_income' => '$' . number_format($sponsorIncome, 2),
                'CTO_income' => '$' . number_format($ctoIncome, 2),
                'wallet_balance' => '$' . number_format($walletBalance, 2),
            ],
            'milestones' => [
                [
                    'title' => 'Self Investment',
                    'description' => 'Deposit at least $2,000 and win an exclusive Thailand tour (4 nights, 5 days) with full luxury accommodation, guided sightseeing, and team networking events.',
                    'progress' => round($thailandProgress, 2),
                ],
                [
                    'title' => 'Self Investment',
                    'description' => 'Deposit a minimum of $5,000 to unlock a premium Dubai tour (5 days, 4 nights), including desert safari, luxury hotel stay, and exclusive company dinner experience.',
                    'progress' => round($dubaiProgress, 2),
                ],
                [
                    'title' => 'CTO Royalty',
                    'description' => 'Bring 20 Referrals, and each referral invests $50. The user will be promoted to CTO, and 3% of the company’s total 24-hour income will be equally distributed among all CTOs as Daily Royalty Income.',
                    'progress' => round($ctoProgress, 2),
                ],
            ],
            'recent_referrals' => UserResource::collection($recentReferrals)->resolve(),
        ];
    }
}
