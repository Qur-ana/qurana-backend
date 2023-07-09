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
            'token' => $this->resource['token'],
            'user' => [
                'id' => $this->resource['user']['id'],
                'name' => $this->resource['user']['name'],
                'email' => $this->resource['user']['email'],
                'phone' => $this->resource['user']['phone'],
                'phone_verified_at' => $this->resource['user']['phone_verified_at'],
                'created_at' => $this->resource['user']['created_at']->format('d-m-Y H:i:s'),
                'created_since' => $this->resource['user']['created_at']->diffForHumans(),
            ],
            'message' => 'Login success',
        ];
    }
}
