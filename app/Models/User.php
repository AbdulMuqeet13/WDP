<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\HasWallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Wallet
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable, HasWallet, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'referral_code',
        'referred_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::created(function ($user) {
            $user->referral_code = 'WDP' . strtoupper(Str::random(6));
            $user->save();
        });
    }

    public function referrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function directReferrals(): HasMany
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function getReferralLevels($maxLevel = 15): array
    {
        $levels = [];
        $currentLevelUsers = collect([$this]); // start with current user

        for ($level = 1; $level <= $maxLevel; $level++) {
            $nextLevelUsers = User::whereIn('referred_by', $currentLevelUsers->pluck('id'))->get();

            if ($nextLevelUsers->isEmpty()) break;

            $levels[$level] = $nextLevelUsers;
            $currentLevelUsers = $nextLevelUsers;
        }

        return $levels;
    }


    public function distributeReferralIncome($amount): void
    {
        $commissionRates = config('referrals');
        $referrer = $this->referrer;
        $level = 1;

        while ($referrer && $level <= 15) {
            $commission = $amount * ($commissionRates[$level] ?? 0);

//            if ($commission > 0) {
//                ReferralIncome::create([
//                    'user_id' => $referrer->id,
//                    'from_user_id' => $this->id,
//                    'level' => $level,
//                    'amount' => $commission,
//                ]);
//            }

            $referrer = $referrer->referrer;
            $level++;
        }
    }

}
