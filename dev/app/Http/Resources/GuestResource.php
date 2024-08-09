<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="GuestResource",
 *     type="object",
 *     title="GuestResource",
 *     required={"uuid", "first_name", "last_name", "email", "phone"},
 *     @OA\Property(property="uuid", type="string", format="uuid", example="123e4567-e89b-12d3-a456-426614174000"),
 *     @OA\Property(property="first_name", type="string", example="Ivan"),
 *     @OA\Property(property="last_name", type="string", example="Ivanov"),
 *     @OA\Property(property="email", type="string", format="email", example="ivan.ivanov@example.com"),
 *     @OA\Property(property="phone", type="string", example="+7234567890"),
 *     @OA\Property(property="country", type="string", example="Russia"),
 * )
 */
class GuestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
