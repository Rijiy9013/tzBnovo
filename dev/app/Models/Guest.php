<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/**
 * @OA\Schema(
 *     schema="Guest",
 *     type="object",
 *     title="Guest",
 *     required={"first_name", "last_name", "email", "phone"},
 *     @OA\Property(property="first_name", type="string", example="Ivan"),
 *     @OA\Property(property="last_name", type="string", example="Ivanov"),
 *     @OA\Property(property="email", type="string", format="email", example="ivan.ivanov@example.com"),
 *     @OA\Property(property="phone", type="string", example="+7234567890"),
 *     @OA\Property(property="country", type="string", example="Russia"),
 * )
 */
class Guest extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'guests';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
    ];

    protected $casts = [
        'uuid' => 'string'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->country = $model->country ?: self::getCountryFromPhone($model->phone);
        });
    }

    private static function getCountryFromPhone($phone)
    {
        $phoneCountryCodes = Cache::remember('phone_country_codes', now()->addDays(7), function () {
            return PhoneCountryCode::all()->pluck('country', 'code')->toArray();
        });

        foreach ($phoneCountryCodes as $code => $country) {
            if (str_starts_with($phone, $code)) {
                return $country;
            }
        }

        return null;
    }
}
