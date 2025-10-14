<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->loadCount('directReferrals')->load('referrer');

        $referralUrl = url('/register?ref=' . $user->referral_code);

        return Inertia::render('Dashboard', [
            'auth' => [
                'user' => [
                    'name' => $user->name,
                    'referral_code' => $user->referral_code,
                    'referral_url' => $referralUrl,
                    'referred_by_name' => $user->referrer?->name,
                    'direct_referrals_count' => $user->direct_referrals_count,
                ],
            ],
        ]);
    }


}
