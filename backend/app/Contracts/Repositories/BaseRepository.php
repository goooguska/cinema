<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseRepository
{
    public function all(): Collection;

    public function findById(int $id): ?Model;

    public function create(array $fields): Model;

    public function update(array $fields, int $id): Model;

    public function updateOrCreate(array $fields, array $values = []): Model;

    public function delete(int $id): bool;

    public function where(array $conditions): Collection;

}
