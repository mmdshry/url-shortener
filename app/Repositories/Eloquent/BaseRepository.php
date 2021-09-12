<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): ?Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }


    /**
     * @param string $redirectId
     * @param array  $payload
     * @return bool
     */
    public function update(string $redirectId, array $payload): bool
    {
        return $this->model->where('redirectId', $redirectId)
            ->update($payload);
    }

    public function destroy(string $redirectId): bool
    {
        return $this->model->where('redirectId', $redirectId)
            ->delete();
    }
}
