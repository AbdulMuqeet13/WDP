<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->loadCount('directReferrals')->load('referrer');

        $referralUrl = url('/register?referral_code=' . $user->referral_code);

        return Inertia::render('Dashboard', [
            'user' => new UserResource($user),
            'referral_url' => $referralUrl,
        ]);
    }


}
