<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "referral_code" => $this->referral_code,
            "referred_by" => $this->referred_by,
            "wallet_balance" => $this->balance,
            "total_investment" => $this->transactions()->whereJsonContains('meta->type', 'User Deposit')->sum('amount'),
            "total_referral_income" => $this->transactions()->whereJsonContains('meta->type', 'Level Income')->sum('amount'),
            "referrer" => $this->whenLoaded('referrer'),
            "directReferrals" => $this->whenLoaded('directReferrals'),
            "direct_referrals_count" => $this->whenCounted('directReferrals'),
            "network_members" => $this->getNetworkMembersCount(),
            'joining_date' => Carbon::parse($this->created_at)->format('d M, Y'),
        ];
    }
}
