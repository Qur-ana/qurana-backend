<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->resource,
            'user' => [
                'id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'email_verified_at' => auth()->user()->email_verified_at,
                'created_at' => auth()->user()->created_at->format('d-m-Y H:i:s'),
                'created_since' => auth()->user()->created_at->diffForHumans(),
            ],
            'message' => 'Login success',
        ];
    }
}
