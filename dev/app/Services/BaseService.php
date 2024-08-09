<?php

namespace App\Services;

use App\Helpers\BaseValidator;
use App\Repositories\BaseRepository;
use App\Services\Interfaces\BaseServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService implements BaseServiceInterface
{
    protected BaseRepository $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): Collection
    {
        return $this->repository->all();
    }

    public function getPaginated(int $perPage): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function getById(string $id): Model
    {
        return $this->repository->find($id);
    }

    public function create(array $data): Model
    {
        $rules = $this->getCreateRules();
        $this->validate($data, $rules);
        return $this->repository->create($data);
    }

    public function update(string $id, array $data): Model
    {
        $rules = $this->getUpdateRules($id);
        $this->validate($data, $rules);
        return $this->repository->update($id, $data);
    }

    public function delete(string $id): Model
    {
        return $this->repository->delete($id);
    }

    protected function validate(array $data, array $rules): void
    {
        BaseValidator::validate($data, $rules);
    }

    abstract protected function getCreateRules(): array;

    abstract protected function getUpdateRules(string $id): array;
}

