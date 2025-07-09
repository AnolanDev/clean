<?php

namespace Clean\Core\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

abstract class BaseRepository
{
    /**
     * The model instance.
     */
    protected Model $model;

    /**
     * Create a new repository instance.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all records.
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Find a record by ID.
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Find a record by ID or fail.
     */
    public function findOrFail($id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Find records by field.
     */
    public function findBy(string $field, $value): Collection
    {
        return $this->model->where($field, $value)->get();
    }

    /**
     * Find first record by field.
     */
    public function findOneBy(string $field, $value): ?Model
    {
        return $this->model->where($field, $value)->first();
    }

    /**
     * Create a new record.
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Update a record.
     */
    public function update($id, array $data): Model
    {
        $record = $this->findOrFail($id);
        $record->update($data);
        
        return $record;
    }

    /**
     * Delete a record.
     */
    public function delete($id): bool
    {
        $record = $this->findOrFail($id);
        
        return $record->delete();
    }

    /**
     * Get paginated records.
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    /**
     * Get records with conditions.
     */
    public function where(string $field, $operator, $value = null): Collection
    {
        if ($value === null) {
            $value = $operator;
            $operator = '=';
        }

        return $this->model->where($field, $operator, $value)->get();
    }

    /**
     * Get records ordered by field.
     */
    public function orderBy(string $field, string $direction = 'asc'): Collection
    {
        return $this->model->orderBy($field, $direction)->get();
    }

    /**
     * Get the model instance.
     */
    public function getModel(): Model
    {
        return $this->model;
    }
}