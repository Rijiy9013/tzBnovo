<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find(string $id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(string $id, array $data): Model
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    public function delete(string $id): Model
    {
        $record = $this->model->findOrFail($id);
        $record->delete();
        return $record;
    }

    public function paginate(int $perPage = 15)
    {
        return $this->model->paginate($perPage);
    }
}
