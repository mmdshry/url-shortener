<?php

namespace App\Repositories\Eloquent\Url;

use App\Models\Urls;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class UrlRepository extends BaseRepository implements UrlRepositoryInterface
{

    /**
     * UserRepository constructor.
     * @param Urls $model
     */
    public function __construct(Urls $model)
    {
        parent::__construct($model);
    }

    /**
     * Returns all model records
     * @return mixed
     */
    public function all()
    {
        return $this->model->paginate();
    }

    /**
     * Find Records by redirectId
     * @param string $redirectId
     * @return Model
     */
    public function findByRedirectId(string $redirectId): ?Model
    {
        return $this->model->where('redirectId', $redirectId)->first();
    }

    /**
     * Check if given redirect id is exists
     * @param string $redirectId
     * @return bool
     */
    public function isRedirectIdExists(string $redirectId): bool
    {
        return $this->model->where('redirectId', $redirectId)->exists();
    }

    /**
     * Determines that is given redirect id has expired or not
     * @param Urls $model
     * @return bool
     */
    public function isRedirectIdValid(Urls $model): bool
    {
        return $model->expires_at ? $model->expires_at->isFuture() : true;
    }
}
