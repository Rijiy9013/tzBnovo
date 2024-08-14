<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class PhoneCountryCode extends Model
{
    use SoftDeletes, HasUuids;

    protected $table = 'phone_country_codes';

    protected $fillable = ['country', 'code'];

    protected $casts = [
        'id' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            Cache::forget('phone_country_codes');
            $codes = self::all()->pluck('country', 'code')->toArray();
            Cache::put('phone_country_codes', $codes, now()->addDays(7));
        });

        static::deleted(function ($model) {
            Cache::forget('phone_country_codes');
            $codes = self::all()->pluck('country', 'code')->toArray();
            Cache::put('phone_country_codes', $codes, now()->addDays(7));
        });
    }
}
