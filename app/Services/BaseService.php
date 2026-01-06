<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Base Service Class
 * Menyediakan operasi CRUD dasar yang dapat di-extend oleh service lain
 */
abstract class BaseService
{
    /**
     * Model class yang dihandle oleh service ini
     * @var string
     */
    protected string $model;

    /**
     * Get model instance
     */
    protected function getModel(): Model
    {
        return new $this->model;
    }

    /**
     * Get query builder
     */
    protected function query()
    {
        return $this->model::query();
    }

    /**
     * Get all records
     */
    public function all(): Collection
    {
        return $this->query()->get();
    }

    /**
     * Get paginated records
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()->paginate($perPage);
    }

    /**
     * Find record by ID
     */
    public function find(string $id): ?Model
    {
        return $this->query()->find($id);
    }

    /**
     * Find record by ID or fail
     */
    public function findOrFail(string $id): Model
    {
        return $this->query()->findOrFail($id);
    }

    /**
     * Create new record
     */
    public function create(array $data): Model
    {
        return $this->model::create($data);
    }

    /**
     * Update existing record
     */
    public function update(string $id, array $data): bool
    {
        $record = $this->find($id);

        if (!$record) {
            return false;
        }

        return $record->update($data);
    }

    /**
     * Delete record
     */
    public function delete(string $id): bool
    {
        $record = $this->find($id);

        if (!$record) {
            return false;
        }

        return $record->delete();
    }

    /**
     * Check if record exists
     */
    public function exists(string $id): bool
    {
        return $this->query()->where($this->getModel()->getKeyName(), $id)->exists();
    }

    /**
     * Count all records
     */
    public function count(): int
    {
        return $this->query()->count();
    }

    /**
     * Get records with conditions
     */
    public function where(array $conditions): Collection
    {
        return $this->query()->where($conditions)->get();
    }

    /**
     * Get first record with conditions
     */
    public function firstWhere(array $conditions): ?Model
    {
        return $this->query()->where($conditions)->first();
    }
}
