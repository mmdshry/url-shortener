<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): ?Model;


    /**
     * @param string $redirectId
     * @param array  $payload
     * @return bool
     */
    public function update(string $redirectId, array $payload): bool;

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model;


    /**
     * @param string $redirectId
     * @return mixed
     */
    public function destroy(string $redirectId);


}
