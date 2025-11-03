<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Interfaces\WalletFloat;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Traits\HasWalletFloat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements WalletFloat
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable, HasWalletFloat, HasRoles;

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
        'is_cto',
        'wallet_address',
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
            do {
                $code = 'WDP' . mt_rand(10000, 99999);
            } while (self::where('referral_code', $code)->exists());

            $user->referral_code = $code;
            $user->save();
        });
    }


    public function scopeActive($query)
    {
        return $query->whereHas('wallet', function ($q) {
            $q->where('balance', '>=', 50);
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

    public function referralTree($depth = 15)
    {
        if ($depth <= 0) {
            return $this->hasMany(User::class, 'referred_by');
        }

        return $this->hasMany(User::class, 'referred_by')
            ->with(['referralTree' => function ($query) use ($depth) {
                $query->with('wallet'); // optional: eager load wallet or stats
            }])
            ->select('id', 'name', 'email', 'referred_by');
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

    public function checkAndPromoteToCTO(): void
    {
        if ($this->balance < 50) {
            return;
        }
        $qualifiedReferrals = $this->directReferrals->filter(function ($ref) {
            $refDeposit = $ref->transactions()
                ->whereJsonContains('meta->type', 'User Deposit')
                ->sum('amount');

            return $refDeposit >= 50;
        })->count();

        if ($qualifiedReferrals >= 20 && !$this->is_cto) {
            $this->update(['is_cto' => 1]);
        } else if ($qualifiedReferrals < 20 && $this->is_cto) {
            $this->update(['is_cto' => 0]);
        }
    }


    public function getNetworkMembersCount(): int
    {
        $count = 0;

        $addReferrals = function ($user) use (&$addReferrals, &$count) {
            foreach ($user->directReferrals as $referral) {
                if ($user->id !== $this->id) {
                    continue;
                }
                $count++;
                // recursively add that referral’s own referrals
                $addReferrals($referral);
            }
        };

        $addReferrals($this);

        return $count;
    }
}
