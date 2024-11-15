<?php

namespace App\Http\Resources;

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
          "uid" => $this->uid,
          "first_name" => $this->first_name,
          "last_name" => $this->last_name,
          "email" => $this->email,
          "password" => $this->password,
          "address" => $this->address,
          "phone" => $this->phone,
          "phone_2" => $this->phone_2,
          "postal_code" => $this->postal_code,
          "birth_date" => $this->birth_date,
          "gender" => $this->gender,
        ];
    }
}