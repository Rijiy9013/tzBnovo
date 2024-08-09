<?php

namespace Database\Seeders;

use App\Models\PhoneCountryCode;
use Illuminate\Database\Seeder;

class PhoneCountryCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $codes = [ // заглушка
            ['country' => 'Russia', 'code' => '+7'],
            ['country' => 'USA', 'code' => '+1'],
        ];

        foreach ($codes as $code) {
            PhoneCountryCode::firstOrCreate(['country' => $code['country']], ['code' => $code['code']]);
        }
    }
}
