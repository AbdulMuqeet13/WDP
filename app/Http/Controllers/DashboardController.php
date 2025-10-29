<?php

namespace App\Http\Controllers;

use App\Actions\GetAdminDashboardData;
use App\Actions\GetUserDashboardData;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->loadCount('directReferrals')->load('referrer');

        $referralUrl = url('/register?referral_code=' . $user->referral_code);

        if ($user->hasRole('admin')) {
            // Admin dashboard data
            $data = GetAdminDashboardData::handle($user, $referralUrl);
            return Inertia::render('Dashboard', $data);
        }

        // User dashboard data
        $data = GetUserDashboardData::handle($user, $referralUrl);
        return Inertia::render('Dashboard', $data);
    }
}
