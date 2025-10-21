<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'type' => ucfirst($this->type),
            'status' => ucfirst($this->status),
            'description' => $this->description,
            'created_at' => Carbon::parse($this->created_at)->format('d M, Y h:i A'),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
