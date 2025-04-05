<?php

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepository as BaseRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;



/**
 * @template TModel of Model
 */
abstract class BaseRepository implements BaseRepositoryContract
{
    public function __construct(protected Model $model) {}

    protected function getModel(): Model
    {
        return $this->model;
    }

    public function all(): Collection
    {
        return $this->getModel()->all();
    }

    /**
     * @return TModel
     */
    public function findById(int $id): ?Model
    {
        return $this->getModel()->findOrFail($id);
    }

    public function create(array $fields): Model
    {
        return $this->getModel()->create($fields);
    }

    public function update(array $fields, int $id): Model
    {
        $record = $this->findById($id);
        $record->update($fields);
        return $record;
    }

    public function updateOrCreate(array $fields, array $values = []): Model
    {
        return $this->model->updateOrCreate($fields, $values);
    }

    public function delete(int $id): bool
    {
        return $this->getModel()->destroy($id);
    }

    public function where($conditions): Collection
    {
        return $this->getModel()->where($conditions)->get();
    }
}
