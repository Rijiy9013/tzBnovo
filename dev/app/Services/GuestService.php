<?php

namespace App\Services;

use App\Models\PhoneCountryCode;
use App\Repositories\GuestRepository;
use App\Services\Interfaces\GuestServiceInterface;
use Illuminate\Support\Facades\Cache;

class GuestService extends BaseService implements GuestServiceInterface
{
    public function __construct(GuestRepository $repository)
    {
        parent::__construct($repository);
    }

    protected function getCreateRules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:guests',
            'phone' => 'required|string|max:20|unique:guests',
            'country' => 'nullable|string|max:255',
        ];
    }

    protected function getUpdateRules(string $id): array
    {
        return [
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:guests,email,' . $id,
            'phone' => 'sometimes|required|string|max:20|unique:guests,phone,' . $id,
            'country' => 'nullable|string|max:255',
        ];
    }
}
