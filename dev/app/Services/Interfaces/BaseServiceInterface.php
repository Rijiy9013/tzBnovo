<?php

namespace App\Services\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseServiceInterface
{
    public function getAll(): Collection;

    public function getPaginated(int $perPage): LengthAwarePaginator;

    public function getById(string $id): Model;

    public function create(array $data): Model;

    public function update(string $id, array $data): Model;

    public function delete(string $id): Model;
}
